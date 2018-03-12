<?php
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
 ?>
