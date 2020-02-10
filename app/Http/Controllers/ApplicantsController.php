<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Applicant;
use App\Model\ApplicantPosition;
use App\Model\Position;
use Illuminate\Support\Facades\Input;

class ApplicantsController extends Controller
{

    public function index()
    {

        $applicant_status = Input::get('applicant_status');
        $position_id = Input::get('position_id');
        $educational_attainment = Input::get('educational_attainment');
        $experience = Input::get('experience');

        // get all applicant id's attached to the position_id selected
        $applicantIDs = [];
        if ($position_id) {
            $applicantIDs = ApplicantPosition::where('position_id', $position_id)
                ->where('application_status', '!=', 'Rejected')
                ->distinct()->pluck('applicant_id')->toArray();
        }

        $applicants = Applicant::leftjoin('users', 'users.id', 'applicants.user_id')
            ->when($applicant_status, function ($query, $applicant_status) {
                return $query->orWhere('users.is_active', $applicant_status);
            })
            ->when($educational_attainment, function ($query, $educational_attainment) {
                return $query->orWhere('applicants.educational_attainment', $educational_attainment);
            })
            ->when($position_id, function ($query, $position_id) use ($applicantIDs) {
                if ($position_id !== []) {
                    return $query->orWhereIn('applicants.id', $applicantIDs);
                }
            })
            ->when($experience, function ($query, $experience) {
                return $query->orWhere('applicants.years_of_work_experience', $experience);
            })
            ->get([
                'users.*', 'applicants.educational_attainment', 'applicants.years_of_work_experience',
                'applicants.resume_file', 'applicants.id as applicant_id', 'applicants.process'
            ])
            ->map(function ($data) {
                $fullname = $data->last_name . ', ' . $data->first_name . ' ' . $data->middle_name;
                $data->fullname = $fullname;

                // count of all applications
                $totalPassed = ApplicantPosition::where('applicant_id', $data->applicant_id)->where('application_status', 'Approved')->count();
                $totalCount = ApplicantPosition::where('applicant_id', $data->applicant_id)->count();

                $data->applicationsPassed = $totalPassed . '/' . $totalCount;

                return $data;
            });

        $positions = Position::all();

        $educationalAttainments = [
            "High School Equivalent",
            "Associate's Degree",
            "Postgraduate",
            "Undergraduate"
        ];

        $years = [
            'Fresh Grad / < 1 Year Experience',
            '1 - 4 Years Experience',
            '5 Years Experience & Up',
            'None'
        ];

        return view('v1/applicants/index', compact('applicants', 'positions', 'educationalAttainments', 'years'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($applicantID)
    {
        $applicant = Applicant::leftjoin('users', 'users.id', 'applicants.user_id')
            ->where('applicants.id', $applicantID)
            ->first([
                'users.*', 'applicants.id as applicant_id', 'applicants.educational_attainment',
                'applicants.years_of_work_experience', 'applicants.process', 'applicants.remarks'
            ]);

        $positionsApplied = ApplicantPosition::leftjoin('positions', 'positions.id', 'applicant_position.position_id')
            ->where('applicant_position.applicant_id', $applicant->applicant_id)
            ->get();

        $totalApprovedApplications = ApplicantPosition::where('applicant_id', $applicant->applicant_id)
            ->where('application_status', 'Approved')
            ->count();

        return view('v1/applicants/edit', compact('applicant', 'positionsApplied', 'totalApprovedApplications'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
