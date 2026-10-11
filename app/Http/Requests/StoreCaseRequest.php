<?php

namespace App\Http\Requests;

use App\Models\MedicalCase;
use Illuminate\Foundation\Http\FormRequest;

class StoreCaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', MedicalCase::class) ?? true;
    }

    public function rules(): array
    {
        return [
            'case_number' => ['required', 'string', 'max:50', 'unique:cases,case_number'],
            'patient_reference' => ['required', 'string', 'max:255'],
            'surgeon_name' => ['required', 'string', 'max:255'],
            'implant_type' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:Draft,Planning,In Review,Approved,Completed,Cancelled'],
            'priority' => ['required', 'string', 'in:Low,Medium,High'],
            'surgery_date' => ['nullable', 'date'],
        ];
    }
}
