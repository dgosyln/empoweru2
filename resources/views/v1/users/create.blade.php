@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        <a href="{{route('users.index')}}" style="text-decoration:none;">Users</a> > Create User
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
      <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="form-group">
          <label for="">Username</label>
          <input type="text" class="form-control" name="username" value="{{old('username')}}" required />
        </div>

        <div class="form-group">
          <label for="">Role</label>
          <select name="role_id" id="role_id" class="form-control">
            <option value="" selected disabled>Select Role</option>
            @foreach($roles as $role)
              <option value="{{$role->id}}" {{$role->id === old('role_id')}}>
                {{$role->name}}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="">First Name</label>
          <input type="text" class="form-control" name="first_name" value="{{old('first_name')}}" required />
        </div>

        <div class="form-group">
          <label for="">Middle Name</label>
          <input type="text" class="form-control" name="middle_name" value="{{old('middle_name')}}" />
        </div>

        <div class="form-group">
          <label for="">Last Name</label>
          <input type="text" class="form-control" name="last_name" value="{{old('last_name')}}" required />
        </div>

        <div class="form-group">
          <label for="">Gender</label>
          <select name="gender" id="gender" class="form-control">
            <option value="">Select Gender</option>
            <option value="1">Male</option>
            <option value="0">Female</option>
          </select>
        </div>

        <div class="form-group">
          <label for="">Email</label>
          <input type="email" class="form-control" name="email" value="{{old('email')}}" />
        </div>

        <div class="form-group">
          <label for="">Contact #</label>
          <input type="text" class="form-control" name="contact_no" value="{{old('contact_no')}}" />
        </div>

        <button class="btn btn-md btn-success pull-right" style="margin-bottom:20px;">
          Submit Form
        </button>
        
      </form>
      
    </div>
  </div>
</div>

@stop