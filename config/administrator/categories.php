<?php

use App\Models\Category;

return [
  'title'  =>'分类',
  'single' =>'分类',
  'model'  =>Category::class,

  'action_permissions' => [
    //删除权限控制
    'delete' => function() {
      //只有站长才能删除话题分类
      return Auth::user()->hasRole('Founder');
    },
  ],

  'columns' => [
     'id' => [
       'title' =>'ID',
     ],
     'name' => [
       'title' =>'名称',
       'sortable' =>false,
     ],
     'description' => [
       'title' =>'描述',
       'sortable' =>false,
     ],
     'operation' => [
       'title' =>'管理',
       'sortable' =>false,
     ],
  ],

  'edit_fields' => [
    'id' => [
         'title' => '分类ID',
    ],
    'name' => [
      'title' =>'名称',
    ],
    'description' => [
      'title' =>'描述',
    ],
  ],
  'filters' => [
    'id' => [
      'title' =>'分类ID',
    ],
    'name' =>[
      'title' =>'名称'
    ],
    'description' => [
      'title' =>'描述',
    ],
  ],
  //新建和编辑时表单的验证规则
  'rules' => [
    'name' =>'required|min:1|unique:categories'
  ],

  //表单验证错误时定制错误消息
  'messages' => [
    'name.required' =>'分类名在数据库中有重复,请选用其他名称',
    'name.unique'  =>'请确保名字至少一个字符以上',
  ],
];
 ?>
