@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        Positions
      </h1>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <a href="{{ route('positions.create') }}" class="btn btn-md btn-info pull-right" style="margin-bottom:15px;">Add Position</a>
      <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
          <tr>
            <th>Position</th>
            <th>Educational Attainment</th>
            <th>Recent Job Experience</th>
            <th>Work Experience</th>
            <th>Date Added</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($positions as $position)
            <tr>
              <td>{{$position->name}}</td>
              <td>{{$position->required_educational_attainment}}</td>
              <td>{{$position->required_recent_job_experience}}</td>
              <td>{{$position->required_years_of_work_experience}}</td>
              <td>{{$position->created_at}}</td>
              <td>
                <a href="{{ route('positions.edit', ['id' => $position->id]) }}">Edit</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <small><i>*List of available positions w/ criteria for passing.</i></small>
    </div>
  </div>

</div>

@stop