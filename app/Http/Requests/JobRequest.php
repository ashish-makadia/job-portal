<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'salary_type' => 'required|in:hour,month,year',
            'job_type' => 'nullable|in:full-time,part-time,contract,freelance',
            'status' => 'nullable|in:active,inactive',
        ];
    }
}