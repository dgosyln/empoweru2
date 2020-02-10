<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Model\Role;
use App\Model\Applicant;
use App\Model\ApplicantPosition;

class AuthController extends Controller
{
    public function validateAuth()
    {
        $user = Auth::User();
        $totalApplicants = Applicant::count();
        $forReviewApplicants = ApplicantPosition::where('application_status', 'For Interview')->count();

        return view('v1/dashboard', compact('user', 'totalApplicants', 'forReviewApplicants'));
    }
}
