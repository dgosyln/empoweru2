@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        <a href="{{route('users.index')}}" style="text-decoration:none;">Users</a> > Edit User: {{$user->fullname}}
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

      <form action="{{route('users.update', ['id' => $user->id])}}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        @csrf

        <div class="form-group">
          <label for="">Username</label>
          <input type="text" class="form-control" name="username" value="{{$user->username}}" required />
        </div>

        <div class="form-group">
          <label for="">Role</label>
          <select name="role_id" id="role_id" class="form-control">
            <option value="" selected disabled>Select Role</option>
            @foreach($roles as $role)
              <option value="{{$role->id}}" {{$role->id === $user->role_id ? 'selected' : ''}}>
                {{$role->name}}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="">First Name</label>
          <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" required />
        </div>

        <div class="form-group">
          <label for="">Middle Name</label>
          <input type="text" class="form-control" name="middle_name" value="{{$user->middle_name}}" />
        </div>

        <div class="form-group">
          <label for="">Last Name</label>
          <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" required />
        </div>

        <div class="form-group">
          <label for="">Gender</label>
          <select name="gender" id="gender" class="form-control">
            <option value="">Select Gender</option>
            <option value="1" {{$user->gender === 1 ? 'selected' : ''}}>Male</option>
            <option value="0" {{$user->gender === 0 ? 'selected' : ''}}>Female</option>
          </select>
        </div>

        <div class="form-group">
          <label for="">Email</label>
          <input type="email" class="form-control" name="email" value="{{$user->email}}" />
        </div>

        <div class="form-group">
          <label for="">Contact #</label>
          <input type="text" class="form-control" name="contact_no" value="{{$user->contact_no}}" />
        </div>

        <button class="btn btn-md btn-success pull-right" style="margin-bottom:20px;">
          Update Form
        </button>
        
      </form>
      
    </div>
  </div>
</div>

@stop