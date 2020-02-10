<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Applicant;
use App\Model\Schedule;
use Illuminate\Support\Facades\Mail;
use App\User;
use DB;

class ScheduleForExaminationController extends Controller
{

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $applicant = Applicant::find($request->applicant_id);
            $applicant->remarks = $request->remarks;
            $applicant->process = 'For Examination';
            $applicant->save();

            Schedule::create([
                'applicant_id' => $request->applicant_id,
                'position_id' => $request->position_id,
                'examination_date' => $request->examination_date
            ]);

            $user = User::find($applicant->user_id);

            $data = [
                'name' => $user->first_name,
                'examination_date' => $request->examination_date
            ];

            Mail::send(['text' => 'v1/utils/exam_mail'], $data, function ($message) use ($user) {
                $message->to($user->email, $user->fullname)->subject('Schedule for Examination');
                $message->from('info@empower.com.ph', 'Empower');
            });

            DB::commit();
            return back()->with('success', 'Exam schedule has been set.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }
}
