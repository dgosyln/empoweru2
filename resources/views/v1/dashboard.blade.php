@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Dashboard</h1>
      </div>
  </div>
  
  <div class="row">

      {{-- applicants --}}
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-primary">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-comments fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">{{$totalApplicants}}</div>
                          <div>Applicants</div>
                      </div>
                  </div>
              </div>
                <a href="{{route('applicants.index')}}">
                  <div class="panel-footer">
                      <span class="pull-left">View Details</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                      <div class="clearfix"></div>
                  </div>
              </a>
          </div>
      </div>

      {{-- reports --}}
      <div class="col-lg-3 col-md-6">
          <div class="panel panel-red">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-comments fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge">
                            <i class="fa fa-file"></i>
                          </div>
                          <div>Reports</div>
                      </div>
                  </div>
              </div>
                <a href="{{route('reports.index')}}">
                  <div class="panel-footer">
                      <span class="pull-left">View Details</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                      <div class="clearfix"></div>
                  </div>
              </a>
          </div>
      </div>
  </div>
</div>

@stop