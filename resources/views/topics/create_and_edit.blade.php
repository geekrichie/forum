@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h2 class="text-center">
                    <i class="glyphicon glyphicon-edit"></i> Topic /
                    @if($topic->id)
                        编辑话题
                    @else
                        创建话题
                    @endif
                </h2>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($topic->id)
                    <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                <div class="form-group">
                	<label for="title-field">Title</label>
                	<input class="form-control" type="text" name="title" id="title-field" value="{{ old('title', $topic->title ) }}" placeholder="请填写标题" required/>
                </div>

                <div class="form-group">
                   <select name="category_id" id="" class="form-control" required>
                    <option value="" hidden disabled selected>请选择分类</option>
                     @foreach($categories as $value)
                     <option value="{{$value->id}}">{{$value->name}}</option>
                     @endforeach
                   </select>
                </div>

                <div class="form-group">
                  <textarea class="form-control" name="body" id="editor" rows="3" placeholder="请填入至少三个字符以上的内容" required>{{old('body',$topic->body)}}</textarea>
                </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/simditor.css')}}">
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('js/module.js')}} "></script>
<script type="text/javascript" src="{{asset('js/hotkeys.js')}} "></script>
<script type="text/javascript" src="{{asset('js/simditor.js')}} "></script>
<script type="text/javascript" src="{{asset('js/uploader.js')}} "></script>
<script type="text/javascript">
    $(document).ready(function(){
     var editor=new Simditor({
       textarea:$('#editor'),
       upload:{
          url:'{{route('topics.upload_image')}}',
          //表单提交的参数，Laravel的POST请求必须带防止CSRF跨站请求的_token参数
          params:{ _token:'{{csrf_token()}}'},
          fileKey:'upload_file',
          //最多同时只能上传一张图片
          connectionCount:3,
          //上传过程中，用户关闭页面时的提醒
          leaveConfirm:'文件上传中,关闭此页面将停止上传。'
       },
       //设定是否支持图片黏贴上传，我们使用true来开启
       pasteImage:true,
     });
   });
</script>
@endsection
