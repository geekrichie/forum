@if(Session::has('message'))
<div class="alert alert-danger">
     <button type="button" class="close" data-dismiss="alert"   aria-hidden="true">×</button>
     {{Session::get('message')}}
</div>
@endif
@if(Session::has('success'))
<div class="alert alert-danger">
     <button type="button" class="close" data-dismiss="alert"   aria-hidden="true">×</button>
     {{Session::get('success')}}
</div>
@endif
@if(Session::has('dangerd'))
<div class="alert alert-danger">
     <button type="button" class="close" data-dismiss="alert"   aria-hidden="true">×</button>
     {{Session::get('danger')}}
</div>
@endif
