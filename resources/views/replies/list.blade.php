@foreach($collections as $reply)
    @include('replies.comment',['reply'=>$reply])
@endforeach