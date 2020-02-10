@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        Reports
      </h1>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div>
            <form action="{{route('reports.index')}}" method="GET" class="row">
              <div class="col-lg-3">
                <label for="">From:</label>
                <input type="date" class="form-control" name="from_date" value="" />
              </div>
              <div class="col-lg-3">
                <label for="">To:</label>
                <input type="date" class="form-control" name="to_date" value="" />
              </div>
              <div class="col-lg-3">
                <label for="">Current Proccess:</label>
                <select name="process" id="" class="form-control">
                  <option value="">-Select Process-</option>
                  <option value="Completed">Completed</option>
                  <option value="Cancelled">Cancelled</option>
                  <option value="Failed">Failed</option>
                </select>
              </div>
              <div class="col-lg-3">
                <label for="">Export To:</label>
                <select name="export_to" id="" class="form-control">
                  <option value="">-Select-</option>
                  <option value="excel">Excel</option>
                </select>
              </div>
              <div class="col-lg-12" style="margin-top: 25px;">
                <button class="btn btn-md btn-info pull-right">Filter Results</button>
              </div>
            </form>
          </div>
        </div>

        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-condensed table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Full Name</th>
                  <th>Contact #</th>
                  <th>Email</th>
                  <th>Educational Attainment</th>
                  <th>Years of Experience</th>
                  <th>Applications Passed</th>
                  <th>Process</th>
                  <th>Date Created</th>
                </tr>
              </thead>
              <tbody>
                @foreach($applicants as $key => $applicant)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$applicant->fullname}}</td>
                  <td>{{$applicant->contact_no}}</td>
                  <td>{{$applicant->email}}</td>
                  <td>{{$applicant->educational_attainment}}</td>
                  <td>{{$applicant->years_of_work_experience}}</td>
                  <td>{{$applicant->applicationsPassed}}</td>
                  <td>{{$applicant->process}}</td>
                  <td>{{$applicant->created_at}}</td>
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