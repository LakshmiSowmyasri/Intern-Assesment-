<?php

namespace App\Http\Requests;

use App\Models\MedicalCase;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        $case = $this->route('case');
        if ($case instanceof MedicalCase) {
            return $this->user()?->can('update', $case) ?? true;
        }

        return true;
    }

    public function rules(): array
    {
        $case = $this->route('case');
        $caseId = $case instanceof MedicalCase ? $case->id : $case;

        return [
            'case_number' => ['required', 'string', 'max:50', Rule::unique('cases', 'case_number')->ignore($caseId)],
            'patient_reference' => ['required', 'string', 'max:255'],
            'surgeon_name' => ['required', 'string', 'max:255'],
            'implant_type' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:Draft,Planning,In Review,Approved,Completed,Cancelled'],
            'priority' => ['required', 'string', 'in:Low,Medium,High'],
            'surgery_date' => ['nullable', 'date'],
        ];
    }
}
