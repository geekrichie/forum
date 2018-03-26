<?php
use App\Models\User;
     function route_class()
     {
       return str_replace('.','-',Route::currentRouteName());
     }
     //preg_replace 函数执行一个正则表达式的搜索和替换。
     //strip_tags剥去字符串中的 HTML、XML 以及 PHP 的标签。
     function make_excerpt($value,$length=200)
     {
       $excerpt=trim(preg_replace("/\r\n|\r|\n+/",' ',strip_tags($value)));
       return str_limit($excerpt,$length);
     }

     function model_admin_link($title,$model)
     {
       return model_link($title,$model,'admin');
     }

     function model_link($title,$model,$prefix='')
     {
       //获取数据模型的复数蛇形命名
       $model_name = model_plural_name($model);

       //初始化前缀
       $prefix = $prefix ? "/".$prefix."/" : '/';

       //使用站点URL拼接全量URL
       $url = config('app.url') . $prefix . $model_name . '/' . $model->id;

      //拼接HTML A 标签,并返回
      return '<a href="' . $url . '" target="_blank">' . $title . '</a>';
     }

     function model_plural_name($model)
     {
       //从实体中获取完整类名，例如: App\Models\User
       $full_class_name = get_class($model);

       //获取基础类名,例如：传参 'App\Models\User' 会得到 User
       $class_name=class_basename($full_class_name);

       //蛇形命名，例如传入User会得到user,FoolBar会得到foo_bar
       $snake_class_name = snake_case($class_name);

       //获取子串的负数形式，例如user会得到users
       return str_plural($snake_class_name);
     }
 ?>
