@extends('layouts.app')
@section('title',$user->name.'的个人中心')
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
      <div class="panel panel-default">
          <div class="panel-body">
            <div class="media">
              <div class="center">
                      <img class="thumbnail img-responsive" src="https://dn-phphub.qbox.me/uploads/avatars/11914_1510813749.jpg?imageView2/1/w/100/h/100" alt="{{$user->name}}">
              </div>
              <div class="media-body">
                <hr>
                <h4> <strong> 个人简介</strong> </h4>
                <p>Lorem isum dolor sit amet, consectetur adipscing elit</p>
                <hr>
                <h4> <strong> 注册于</strong></h4>
                <p>Janury 01 1901</p>
              </div>
            </div>
          </div>
      </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class=" panel panel-default">
             <div class="panel-body">
                <span>
                  <h1 class="panel-title pull-left" style="font-size:30px;">{{$user->name}}<small style="margin-left:5px">{{ $user->email }}</small></h1>
                </span>
             </div>
          </div>
          <hr>
          <!-- 用户发布的内容-->
        <div class="panel panel-default">
              <div class="panel-body">
                    暂无数据~_~
              </div>
        </div>
    </div>
  </div>
@stop
