@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">List of Applicants</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div>
            <form action="{{route('applicants.index')}}" method="GET" class="row no-gutters" style="margin-bottom: 10px;">

              {{-- applicant status --}}
              <div class="col-lg-2">
                <label for="">Application Status</label>
                <select name="applicant_status" id="" class="form-control">
                  <option value="">-Select Status-</option>
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>

              {{-- position_id --}}
              <div class="col-lg-2">
                <label for="">Position</label>
                <select name="position_id" id="" class="form-control">
                  <option value="">-Select Position-</option>
                  @foreach($positions as $position)
                    <option value="{{$position->id}}">{{$position->name}}</option>
                  @endforeach
                </select>
              </div>

              {{-- educational_attainment --}}
              <div class="col-lg-3">
                <label for="">Educational Attainment</label>
                <select name="educational_attainment" id="" class="form-control">
                  <option value="">-Select Educational Attainment-</option>
                  @foreach($educationalAttainments as $educationalAttainment)
                    <option value="{{$educationalAttainment}}">{{$educationalAttainment}}</option>
                  @endforeach
                </select>
              </div>

              {{-- experience --}}
              <div class="col-lg-3">
                <label for="">Experience</label>
                <select name="experience" id="" class="form-control">
                  <option value="">-Select Experience-</option>
                  @foreach($years as $year)
                    <option value="{{$year}}">{{$year}}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-lg-2" style="margin-top: 25px;">
                <button type="submit" class="btn btn-md btn-info">Filter Results</button>
              </div>

            </form>
          </div>
        </div>

        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-condensed">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Full Name</th>
                  <th>Gender</th>
                  <th>Contact #</th>
                  <th>Applications Passed</th>
                  <th>Resume</th>
                  <th>Applicant Status</th>
                  <th>Current Process</th>
                  <th>Date Added</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($applicants as $key => $applicant)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$applicant->fullname}}</td>
                  <td>{{$applicant->gender == 1 ? 'Male' : 'Female'}}</td>
                  <td>{{$applicant->contact_no}}</td>
                  <td>{{$applicant->applicationsPassed}}</td>
                  <td>
                    <a href="{{$applicant->resume_file}}" download>Download</a>
                  </td>
                  <td>{{$applicant->is_active ? 'Active' : 'Inactive'}}</td>
                  <td>{{$applicant->process}}</td>
                  <td>{{$applicant->created_at}}</td>
                  <td width="10%">
                    <a href="{{route('applicants.edit', ['id' => $applicant->applicant_id])}}">View Details</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

@stop