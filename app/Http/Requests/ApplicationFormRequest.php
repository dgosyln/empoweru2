<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'resume_file' => 'required|mimetypes:application/pdf|max:10000',
            'email' => 'required|email|unique:users,email',
            'educational_attainment' => 'required',
            'years_of_work_experience' => 'required',
            'position_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'resume_file.required' => 'Resume File field is required.',
            'resume_file.mimetypes' => 'Resume File must be in pdf format.'
        ];
    }
}
