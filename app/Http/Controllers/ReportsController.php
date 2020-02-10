<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Model\Applicant;
use App\Model\ApplicantPosition;
use App\User;
use Excel;

class ReportsController extends Controller
{

    public function index()
    {

        $from_date = Input::get('from_date');
        $to_date = Input::get('to_date');
        $process = Input::get('process');
        $export_to = Input::get('export_to');

        $applicants = Applicant::leftjoin('users', 'users.id', 'applicants.user_id')
            ->when($from_date, function ($query) use ($from_date, $to_date) {
                return $query->where('users.created_at', '>=', $from_date . ' 00:00:00')->where('users.created_at', '<=', $to_date . ' 23:59:59');
            })
            ->when($process, function ($query) use ($process) {
                return $query->where('applicants.process', $process);
            })
            ->get([
                'users.*', 'applicants.educational_attainment', 'applicants.years_of_work_experience',
                'applicants.id as applicant_id', 'applicants.process'
            ])
            ->map(function ($data) {
                $data->fullname = $data->last_name . ', ' . $data->first_name . ' ' . $data->middle_name;

                $totalPassed = ApplicantPosition::where('applicant_id', $data->applicant_id)->where('application_status', 'Approved')->count();
                $totalCount = ApplicantPosition::where('applicant_id', $data->applicant_id)->count();
                $data->applicationsPassed = $totalPassed . '/' . $totalCount;

                return $data;
            });

        if ($export_to == 'excel') {

            $data = [];
            $reportName = 'reports_' . time();

            return Excel::create($reportName, function ($excel) use ($data, $applicants) {
                $excel->sheet('mySheet', function ($sheet) use ($data, $applicants) {
                    $sheet->setFontSize(15);

                    $data[] = [
                        '#',
                        'Full Name',
                        'Contact #',
                        'Email',
                        'Educational Attainment',
                        'Years of Experience',
                        'Applications Passed',
                        'Process',
                        'Date Created'
                    ];

                    foreach ($applicants as $key => $applicant) {
                        $data[] = [
                            $key + 1,
                            $applicant['fullname'],
                            $applicant['contact_no'],
                            $applicant['email'],
                            $applicant['educational_attainment'],
                            $applicant['years_of_work_experience'],
                            $applicant['applicationsPassed'],
                            $applicant['process'],
                            $applicant['created_at']
                        ];
                    }

                    $sheet->fromArray($data);
                });
            })->download('xlsx');
        }


        return view('v1/reports/index', compact('applicants'));
    }
}
