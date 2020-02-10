<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ApplicantPosition;
use App\Model\Applicant;
use App\User;

class CancelApplicationController extends Controller
{

    public function edit($applicationID)
    {
        $applicant = Applicant::find($applicationID);
        $applicant->process = 'Cancelled';
        $applicant->save();

        User::find($applicant->user_id)->update(['is_active' => 0]);

        return back()->with('success', 'Application Cancelled.');
    }
}
