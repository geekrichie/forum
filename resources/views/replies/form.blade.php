<form method="POST" action="{{route('topics.reply',['topic'=>$topic->id])}}" accept-charset="UTF-8">
    {{csrf_field()}}

    @if(isset($parentId))
        <input type="hidden" name="parent_id" value="{{$parentId}}">
    @endif

    <div class="form-group">
        <label for="content" class="control-label">Info:</label>
        <textarea id="content" name="content"  class="form-control" required="required"></textarea>
    </div>
    <button type="submit" class="btn btn-success">回复</button>
</form>