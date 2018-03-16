@if(count($topics))
<ul class="list-group">
  @foreach($topics as $topic)
     <li class="list-group-item">
       <a href="{{$topic->link()}}">
         {{$topic->title}}
       </a>
       <span class="meta pull-right">
        {{$topic->reply_count}}回复
         <span>.</span>
        {{$topic->created_at->diffForHumans()}}
       </span>
     </li>
  @endforeach
</ul>
@endif

{{-- 分页 --}}
{!! $topics->render() !!}
