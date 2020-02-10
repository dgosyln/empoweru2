@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Manage Users</h1>
    </div>

    <div class="col-lg-12">
      <a href="{{ route('users.create') }}" class="btn btn-md btn-info pull-right" style="margin-bottom:15px;">Add User</a>

      <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
          <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Contact #</th>
            <th>Email</th>
            <th>Account Status</th>
            <th>Date Added</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $key => $user)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$user->full_name}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->contact_no ? $user->contact_no : 'N/A'}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->is_active == 1 ? 'Active' : 'Inactive'}}</td>
            <td>{{$user->created_at}}</td>
            <td>
              <form method="POST" action="{{route('users.destroy', ['id' => $user->id])}}">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-info">Edit</a>
              
                @if($user->is_active)
                  <button type="submit" onclick="return confirm('Are you sure?');" class="btn btn-danger">Deactivate</button>
                @else
                  <button type="submit" onclick="return confirm('Are you sure?');" class="btn btn-success">Activate</button>
                @endif
              </form>              
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
</div>

@stop