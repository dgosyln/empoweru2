<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Applicant;
use App\User;

class FinalInterviewResultsController extends Controller
{
    public function edit($applicantID, $status)
    {
        $status == 'completed' ? $process = 'Completed' : $process = 'Failed';
        $applicant = Applicant::find($applicantID);
        $applicant->process = $process;
        $applicant->save();

        $user = User::find($applicant->user_id);
        $user->is_active = 0;
        $user->save();

        return back()->with('success', 'Final result has been set.');
    }
}
