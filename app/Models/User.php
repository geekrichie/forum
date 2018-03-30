<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Topic;
use Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use Traits\ActiveUserHelper;
    use Traits\LastActivedAtHelper;
    use Notifiable{
      notify as protected laravelNotify;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','introduction','avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function notify($instance){
      //如果要通知的人是当前用户，就不必通知了
      if($this->id== Auth::id()){
        return ;
      }
      $this->increment('notifications_count');
      $this->laravelNotify($instance);
    }

    public function markAsRead()
    {
           $this->notifications_count=0;
           $this->save();
           $this->unreadNotifications->markAsRead();
    }
    public function topics()
    {
      return $this->hasMany(Topic::class);
    }
    public function replies()
    {
      return $this->hasMany(Reply::class);
    }
    public function isAuthorOf($model)
    {
      return $this->id==$model->user_id;
    }
    public function setPasswordAttribute($value)
    {
      //如果值的长度小于60，即认为是已经加密的情况
         if(strlen($value) !=60)
         {
              $value=bcrypt($value);
         }
         $this->attributes['password']= $value;
    }

    public function setAvatarAttribute($path)
    {
          if(! starts_with($path, 'http'))
          {
            $path=config('app.url').'/uploads/images/avatars/'.$path;
          }
          $this->attributes['avatar']=$path;
    }
}
