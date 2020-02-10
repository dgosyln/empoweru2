<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Applicant;
use App\User;

class ExaminationResultsController extends Controller
{

    public function edit($applicantID, $status)
    {

        $status == 'passed' ? $process = 'Final Interview' : $process = 'Failed';
        $applicant = Applicant::find($applicantID);
        $applicant->process = $process;
        $applicant->save();

        if ($status == 'failed') {
            $user = User::find($applicant->user_id);
            $user->is_active = 0;
            $user->save();
        }

        return back()->with('success', 'Examination result has been set.');
    }
}
