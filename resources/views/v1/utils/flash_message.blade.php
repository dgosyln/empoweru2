
@if( Session::has("success") )
<div class="alert alert-success">
  <i class="icon-remove close" data-dismiss="alert"></i>
  <strong>{!! Session::get("success") !!}</strong>
</div>
@endif

@if( Session::has("error") )
<div class="alert alert-danger">
  <i class="icon-remove close" data-dismiss="alert"></i>
  <strong>{!! Session::get("error") !!}</strong>
</div>
@endif
