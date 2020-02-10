@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        <a href="{{route('applicants.index')}}">Applicants</a> > View Details
      </h1>
    </div>
  </div>

  {{-- applicant details --}}
  <div class="row">
    <div class="col-lg-12">
      <h3>Applicant Details</h3>
      <hr />
    </div>

    <div class="col-lg-6">
      <label for="">Full Name:</label>
      <span>{{$applicant->last_name.', '.$applicant->first_name.' '.$applicant->middle_name}}</span>
    </div>

    <div class="col-lg-6">
      <label for="">Educational Attainment:</label>
      <span>{{$applicant->educational_attainment}}</span>
    </div>

    <div class="col-lg-6">
      <label for="">Contact #:</label>
      <span>{{$applicant->contact_no}}</span>
    </div>

    <div class="col-lg-6">
      <label for="">Total years of Experience:</label>
      <span>{{$applicant->years_of_work_experience}}</span>
    </div>

    <div class="col-lg-6">
      <label for="">Email Address:</label>
      <span>{{$applicant->email}}</span>
    </div>

    <div class="col-lg-6">
      <label for="">Current Process:</label>
      <span>{{$applicant->process}}</span>
    </div>

    <div class="col-lg-6">
      <label for="">Remarks:</label>
      <span>{{$applicant->remarks}}</span>
    </div>

  </div>

  {{-- applicant progress --}}
  <div class="row" style="margin-top: 50px;">
    <div class="col-lg-12">
      <h3>Applicant's Progress</h3>
      <hr />

      <ul class="progressbar">
        <li class="{{$applicant->process == "Initial Interview" || $applicant->process == "For Examination" || $applicant->process == "Final Interview" || $applicant->process == "Completed" ? 'active' : ''}}">
          Application Submission {{$applicant->process == "Initial Interview" || $applicant->process == "For Examination" || $applicant->process == "Final Interview" || $applicant->process == "Completed" ? html_entity_decode('&#10003;') : ''}}
        </li>
        <li class="{{$applicant->process == "For Examination" || $applicant->process == "Final Interview" || $applicant->process == "Completed" ? 'active' : ''}}">
          Initial Interview {{$applicant->process == "For Examination" || $applicant->process == "Final Interview" || $applicant->process == "Completed" ? html_entity_decode('&#10003;') : ''}}
        </li>
        <li class="{{$applicant->process == "Final Interview" || $applicant->process == "Completed" ? 'active' : ''}}">
          For Examination {{$applicant->process == "Final Interview" || $applicant->process == "Completed" ? html_entity_decode('&#10003;') : ''}}
        </li>
        <li class="{{$applicant->process == "Completed" ? 'active' : ''}}">
          Final Interview {{$applicant->process == "Completed" ? html_entity_decode('&#10003;') : ''}}
        </li>
      </ul>
    </div>
  </div>

  {{-- list of applications --}}
  <div class="row" style="margin-top: 50px;">

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

    <div class="col-lg-6" style="margin-bottom: 70px; {{!$applicant->is_active ? 'display: none;' : ''}}">
      <span>
        <h3>Schedule For Examination</h3>
        <p>
          <a 
            href="{{route('cancel-application.edit', ['id' => $applicant->applicant_id])}}"
            class="text-danger" 
            style="text-decoration: underline;"
            onclick="return confirm('Are you sure you want to cancel this application?');"
          >
            Cancel Application
          </a>
        </p>
      </span>
      <hr />

      <form action="{{ route('scheduleForExamination.store') }}" method="POST">
        @csrf

        <input type="hidden" name="applicant_id" value="{{$applicant->applicant_id}}">

        <div class="form-group">
          <label for="">Position</label>
          <select name="position_id" id="" class="form-control" required />
            <option value="">-Select Position-</option>
            @foreach($positionsApplied as $position)
              <option value="{{$position->id}}">{{$position->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="">Date of Examination</label>
          <input type="date" class="form-control" name="examination_date" required />
        </div>

        <div class="form-group">
          <label for="">Remarks</label>
          <textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control"></textarea>
        </div>

        <div class="form-group">
          <div class="checkbox">
            <label><input type="checkbox" value="1">Send Email Notification</label>
          </div>
        </div>

        <button class="btn btn-md btn-success pull-right" onclick="return confirm('Schedule for examination?');">Submit Schedule</button>
      </form>
    </div>

    <div class="col-lg-6">
      <h3>Positions Applied</h3>
      <hr />
      <table class="table table-bordered table-condensed table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Position</th>
            <th class="text-center">Application Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($positionsApplied as $key => $position)
          <tr class="{{$position->application_status == 'Approved' ? 'success' : 'active'}}">
            <td>{{$key+1}}</td>
            <td>{{$position->name}}</td>
            <td class="text-center">
              {{$position->application_status}}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
    @if($applicant->process == "For Examination")
      <div class="col-lg-6">
        <h3>Examination Results:</h3>
        <a href="{{route('examinationResults.edit', ['applicant_id' => $applicant->applicant_id, 'status' => 'passed'])}}" onclick="return confirm('Are you sure?');">Passed</a> / 
        <a href="{{route('examinationResults.edit', ['applicant_id' => $applicant->applicant_id, 'status' => 'failed'])}}" onclick="return confirm('Are you sure?');">Failed</a>
        <hr />
      </div>
    @endif

    @if($applicant->process == "Final Interview")
      <div class="col-lg-6">
        <h3>Final Interview Result:</h3>
        <a href="{{route('finalInterviewResults.edit', ['applicant_id' => $applicant->applicant_id, 'status' => 'completed'])}}" onclick="return confirm('Are you sure?');">Completed</a> / 
        <a href="{{route('finalInterviewResults.edit', ['applicant_id' => $applicant->applicant_id, 'status' => 'declined'])}}" onclick="return confirm('Are you sure?');">Declined</a>
        <hr />
      </div>
    @endif

  </div>
</div>

@stop