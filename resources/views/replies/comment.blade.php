<div class="col-md-12">
    <h5><span style="color:#31b0d5">{{$reply->user->name}}</span>:</h5>
    <h5>{!! $reply->content !!}</h5>

    @include('replies.form',['parentId'=>$reply->id])

    @if(isset($replies[$reply->id]))
        @include('replies.list',['collections'=>$replies[$reply->id]])
    @endif
    <hr>
</div>