@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        <a href="{{route('positions.index')}}" style="text-decoration:none;">Positions</a> > Edit Position: {{$position->name}}
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

      <form action="{{route('positions.update', ['id' => $position->id])}}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="position_id" value="{{ $position->id }}">
        @csrf

        <div class="form-group">
          <label for="">Position</label>
          <input type="text" class="form-control" name="name" value="{{$position->name}}" />
        </div>

        <div class="form-group">
          <label for="">Required Educational Attainment</label>
          <select name="required_educational_attainment" id="required_educational_attainment" class="form-control">
            <option value="" selected disabled>Select Option</option>
            @foreach($educationalAttainments as $educationalAttainment)
              <option value="{{$educationalAttainment}}" {{$educationalAttainment === $position->required_educational_attainment ? 'selected' : ''}}>
                {{$educationalAttainment}}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="">Required Recent Job Experience</label>
          <input type="text" class="form-control" name="required_recent_job_experience" value="{{$position->required_recent_job_experience}}" required />
        </div>

        <div class="form-group">
          <label for="">Required Years of Work Experience</label>
          <select name="required_years_of_work_experience" id="required_years_of_work_experience" class="form-control">
            <option value="" selected disabled>Select Option</option>
            @foreach($years as $year)
              <option value="{{$year}}" {{$year === $position->required_years_of_work_experience ? 'selected' : ''}}>
                {{$year}}
              </option>
            @endforeach
          </select>
        </div>

        <button class="btn btn-md btn-success pull-right" style="margin-bottom:20px;" onclick="return confirm('Are you sure?');">
          Update Form
        </button>
        
      </form>
      
    </div>
  </div>
</div>

@stop