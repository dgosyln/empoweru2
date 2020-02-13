<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PositionRequest;
use App\Model\Position;

class PositionController extends Controller
{

    public function index()
    {
        $positions = Position::latest()->get();
        return view('v1/positions/index', compact('positions'));
    }

    public function create()
    {
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

        return view('v1/positions/create', compact('educationalAttainments', 'years'));
    }

    public function store(PositionRequest $request)
    {

        Position::create([
            'name' => $request->name,
            'required_educational_attainment' => $request->required_educational_attainment,
            'required_recent_job_experience' => $request->required_recent_job_experience,
            'required_years_of_work_experience' => $request->required_years_of_work_experience
        ]);

        return back()->with('success', 'Position created successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $position = Position::find($id);

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

        return view('v1/positions/edit', compact('position', 'educationalAttainments', 'years'));
    }

    public function update(PositionRequest $request, $id)
    {
        $position = Position::find($id);

        $position->update([
            'name' => $request->name,
            'required_educational_attainment' => $request->required_educational_attainment,
            'required_recent_job_experience' => $request->required_recent_job_experience,
            'required_years_of_work_experience' => $request->required_years_of_work_experience
        ]);

        return back()->with('success', 'Position updated successfully');
    }

    public function destroy($id)
    {
        //
    }
}
