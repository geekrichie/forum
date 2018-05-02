<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Reply;
use App\Http\Requests\TopicRequest;
use Auth;
use App\Handlers\ImageUploadHandler;
use App\Models\Link;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request,Topic $topic,User $user,Link $link)
	{
    //paginate 默认分页是每页15个数据
    //使用Eloquent的預加載功能來加快查詢
		$topics = Topic::withOrder($request->order)->paginate(20);
    $active_users = $user->getActiveUsers();
    $links = $link->getAllCached();
    
		return view('topics.index', compact('topics','active_users','links'));
	}

    public function show(Request $request,Topic $topic)
    {
       //URL矫正
       if(!empty($topic->slug)&&$topic->slug!=$request->slug){
        return redirect($topic->link(),301);
       }
        $topic->load('replies.user');
        $replies = $topic->getReplies();
        $replies['root'] = $replies[''];
        unset($replies['']);
        return view('topics.show', compact('topic','replies'));
    }


    public function postReply(Topic $topic, Request $request)
    {
      // dd($request->content);
      $reply = new Reply();
      $reply->content=$request->content;
      $reply->user_id=Auth::id();
      $reply->topic_id=$topic->id;
      $reply->parent_id= $request->parent_id;
      $reply->save();
        return back();
    }
    
	public function create(Topic $topic)
	{
      $categories=Category::all();
		  return view('topics.create_and_edit', compact('topic','categories'));
	}

	public function store(TopicRequest $request,Topic $topic)
	{
    $topic->fill($request->all());
    $topic->user_id=Auth::id();
		$topic->save();
		return redirect()->to($topic->link())->with('success', '成功创建主题!');
	}

	public function edit(Topic $topic)
	{
    $this->authorize('update', $topic);
    $categories=Category::all();
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->to($topic->link())->with('success', '更新成功!');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('success', '删除成功!');
	}
  /**
   * 处理图片上传的逻辑
   */
   public function uploadImage(Request $request,ImageUploadHandler $handler)
   {
     //初始化返回数据,默认是失败的
     $data=[
       'success'=>false,
       'msg'=>'上传失败',
       'file_path'=>''
     ];
     //判断是否有上传文件,并赋值给$file
     if($file=$request->upload_file){
       //保存图片到本地
       $result=$uploader->save($request->upload_file,'topics',\Auth::id(),1024);
       //图片保存成功的话
       if($result){
         $data['file_path']=$result['path'];
         $data['msg']="上传成功!";
         $data['success']=true;
       }
     }
     return $data;
   }
}
