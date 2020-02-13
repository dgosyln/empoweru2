<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApplicationFormRequest;
use App\Model\Position;
use App\Model\Applicant;
use App\Model\ApplicantPosition;
use App\User;
use App\Model\Role;
use DB;

class ApplicationFormController extends Controller
{

    public function create()
    {
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

        return view('v1/application-form/create', compact('positions', 'educationalAttainments', 'years'));
    }

    public function store(ApplicationFormRequest $request)
    {

        DB::beginTransaction();

        try {
            $request->recent_job_experience == null ? $recentJobExperience = 'N/A' : $recentJobExperience = $request->recent_job_experience;
            $request->company == null ? $company = 'N/A' : $company = $request->company;

            $user = User::create([
                'role_id' => Role::_APPLICANT,
                'username' => substr(md5(mt_rand()), 0, 7),
                'password' => bcrypt('password'),
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'contact_no' => $request->contact_no,
                'email' => $request->email
            ]);

            // process resume file here
            if ($request->hasFile('resume_file')) {
                $image = $request->resume_file;
                $resume_new_name = time() . $image->getClientOriginalName();
                $image->move('uploads', $resume_new_name);
                $final_resume = 'uploads/' . $resume_new_name;
            } else {
                $final_resume = null;
            }

            $applicant = Applicant::create([
                'user_id' => $user->id,
                'age' => $request->age,
                'educational_attainment' => $request->educational_attainment,
                'undergraduate_year_level' => $request->undergraduate_year_level,
                'city' => $request->city,
                'recent_job_experience' => $recentJobExperience,
                'company' => $company,
                'years_of_work_experience' => $request->years_of_work_experience,
                'resume_file' => $final_resume,
                'process' => 'Initial Interview'
            ]);

            // store all applications
            if (count($request->position_id)) {
                foreach ($request->position_id as $position_id) {

                    // selection criteria
                    $positionApplied = Position::find($position_id);

                    if (
                        $positionApplied->required_educational_attainment == $request->educational_attainment
                        || $positionApplied->required_recent_job_experience == $request->recent_job_experience
                        || $positionApplied->required_years_of_work_experience == $request->years_of_work_experience
                    ) {

                        $status = 'Approved';
                    } else {
                        $status = 'Rejected';
                    }

                    ApplicantPosition::create([
                        'applicant_id' => $applicant->id,
                        'position_id' => $position_id,
                        'application_status' => $status
                    ]);
                }
            }

            // 
            $totalPassed = ApplicantPosition::where('applicant_id', $applicant->id)->where('application_status', 'Approved')->count();
            $totalCount = ApplicantPosition::where('applicant_id', $applicant->id)->count();

            if ($totalPassed === 0) {
                // User::find($user->id)->delete();
                Applicant::find($applicant->id)->update(['process' => 'Failed']);
                // ApplicantPosition::where('applicant_id', $applicant->id)->delete();
            }

            DB::commit();
            return back()->with('success', 'Application has been submitted!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
