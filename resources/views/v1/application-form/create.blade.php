<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>EmpowerU | Application Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('template/css/custom.css') }}">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

  <div class="container h-100">
    <div class="row align-items-center h-100 py-5">
      <div class="col-lg-10 col-12 mx-auto">
        <div class="text-center">
          <img src="{{asset('template/images/form-img.png')}}" class="img-fluid " width="200" alt="">
        </div>

        <div class="row no-gutters">
          <div class="col-lg-12">
            @include('v1/utils/flash_message')
            @if($errors->any())
              <div class="alert alert-danger">
                <i class="icon-remove close" data-dismiss="alert"></i>
                @foreach($errors->all() as $error)
                  <li style="display: inline;">{{$error}}</li><br>
                @endforeach
              </div>
            @endif
          </div>
        </div>

        <div class="card mt-2">
          <div class="card-body">
            
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <small>Apply with us</small>
                  <hr />
                </div>
              </div>

              <form action="{{ route('application_form.store') }}" class="row" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- first name --}}
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="" class="required font-weight-bold">FIRST NAME</label>
                    <input type="text" class="form-control" name="first_name" value="{{old('first_name')}}" />
                  </div>
                </div>

                {{-- middle name --}}
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="" class="font-weight-bold">MIDDLE NAME</label>
                    <input type="text" class="form-control" name="middle_name" value="{{old('middle_name')}}" />
                  </div>
                </div>

                {{-- last name --}}
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="" class="required font-weight-bold">LAST NAME</label>
                    <input type="text" class="form-control" name="last_name" value="{{old('last_name')}}" />
                  </div>
                </div>

                {{-- gender --}}
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="" class="required font-weight-bold">GENDER</label>
                    <select name="gender" id="" class="form-control">
                      <option value="1" {{old('gender') === 1 ? 'selected' : ''}}>Male</option>
                      <option value="0" {{old('gender') === 0 ? 'selected' : ''}}>Female</option>
                    </select>
                  </div>
                </div>

                {{-- age --}}
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="" class="required font-weight-bold">AGE</label>
                    <input type="number" class="form-control" name="age" value="{{old('age')}}" />
                  </div>
                </div>

                {{-- current city --}}
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="" class="required font-weight-bold">CURRENT CITY</label>
                    <input type="text" class="form-control" name="city" value="{{old('city')}}" />
                  </div>
                </div>

                {{-- contact no --}}
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="" class="required font-weight-bold">CONTACT #</label>
                    <input type="text" class="form-control" name="contact_no" value="{{old('contact_no')}}" required />
                  </div>
                </div>

                {{-- email --}}
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="" class="required font-weight-bold">EMAIL</label>
                    <input type="email" class="form-control" name="email" value="{{old('email')}}" required />
                  </div>
                </div>

                {{-- educational attainment --}}
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="" class="required font-weight-bold">EDUCATIONAL ATTAINMENT</label>

                    @foreach($educationalAttainments as $educationalAttainment)
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="educational_attainment" value="{{$educationalAttainment}}"
                        {{$educationalAttainment == old('educational_attainment') ? 'checked' : ''}}>
                        {{$educationalAttainment}}
                      </label>
                    </div>
                    @endforeach

                    <input 
                      type="text" 
                      class="form-control form-control-sm mt-2" 
                      name="undergraduate_year_level" 
                      placeholder="If undergraduate specify year Level:"
                      value="{{old('undergraduate_year_level')}}"
                    />
                  </div>
                </div>

                {{-- recent job experience || years of work experience --}}
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="" class="font-weight-bold">YEARS OF WORK EXPERIENCE</label>

                    <input 
                      type="text" 
                      class="form-control form-control-sm mb-0" 
                      name="recent_job_experience" 
                      value="{{old('recent_job_experience')}}" 
                      placeholder="Ex. Customer Service"
                    />
                    <small class="mb-2 float-right">*Recent Job Experience</small>
                    <br/>
                    <hr/>

                    @foreach($years as $year)
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="years_of_work_experience" value="{{$year}}"
                        {{$year == old('years_of_work_experience') ? 'checked' : ''}}>
                        {{$year}}
                      </label>
                    </div>
                    @endforeach

                  </div>
                </div>

                {{-- company --}}
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="" class="font-weight-bold">PREVIOUS COMPANY</label>
                    <input type="text" class="form-control" name="company" value="{{old('company')}}" placeholder="N/A" />
                  </div>
                </div>

                {{-- position you're applying for --}}
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="" class="required font-weight-bold">POSITION YOU'RE APPLYING FOR</label>

                    @foreach($positions as $position)
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="position_id[]" value="{{$position->id}}"
                          @if(is_array(old('position_id')) && in_array($position->id, old('position_id'))) checked @endif>{{$position->name}}
                        </label>
                      </div>
                    @endforeach

                    <div class="form-group">
                      <label for="" class="mb-1">OTHERS:</label>
                      <input 
                        type="text" 
                        class="form-control form-control-sm" 
                        name="job_position_others" 
                        value="{{old('job_position_others')}}" 
                        placeholder="Please Specify"
                      />
                    </div>
                  </div>
                </div>

                {{-- download resume template (optional) --}}
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="" class="font-weight-bold">DOWNLOAD RESUME TEMPLATE (OPTIONAL)</label>
                    <a href="{{ asset('template/docs/sample.docx') }}" download>Download EU Template</a>
                  </div>
                </div>

                {{-- upload resume (pdf only) --}}
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="" class="font-weight-bold">UPLOAD RESUME (PDF ONLY)</label>
                    <input type="file" name="resume_file" />
                  </div>
                </div>

                {{-- submit button --}}
                <div class="col-lg-12 mt-2">
                  <hr/>
                  <button type="submit" class="btn btn-md btn-success float-right" onclick="return confirm('Are you sure you want to submit this application?');">Submit Application</button>
                </div>

              </form>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

</body>
</html>