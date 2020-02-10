@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        User Profile
      </h1>
    </div>

    <div class="col-lg-12">
      @include('v1/utils/flash_message')
      @if($errors->any())
        <div class="alert alert-sm alert-danger fade in">
            <i class="icon-remove close" data-dismiss="alert"></i>
            @foreach($errors->all() as $error)
                <li style="display: inline;">{{ $error }}</li><br>
            @endforeach
        </div>
      @endif
    </div>

    <div class="col-lg-6">

      <form action="{{route('user-profile.update', ['id' => $user->id])}}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        @csrf

        <div class="form-group">
          <label for="" class="required">Role</label>
          <input type="text" class="form-control" value="{{$user->role}}" disabled />
        </div>

        <div class="form-group">
          <label for="" class="required">First Name</label>
          <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" required />
        </div>

        <div class="form-group">
          <label for="" class="required">Middle Name</label>
          <input type="text" class="form-control" name="middle_name" value="{{$user->middle_name}}" />
        </div>

        <div class="form-group">
          <label for="" class="required">Last Name</label>
          <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" required />
        </div>

        <div class="form-group">
          <label for="">Email Address</label>
          <input type="email" class="form-control" name="email" value="{{$user->email}}" />
        </div>

        <div class="form-group">
          <label for="">Contact #</label>
          <input type="text" class="form-control" name="contact_no" value="{{$user->contact_no}}" />
        </div>

        <button class="btn btn-md btn-success pull-right" style="margin-bottom:20px;">
          Update Profile
        </button>
        
      </form>
      
    </div>

  </div>
</div>

@stop