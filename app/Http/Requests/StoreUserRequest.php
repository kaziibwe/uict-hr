<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //

            'department_id' => 'nullable|exists:departments,id',
            'name' => 'required',
            'title' => 'nullable',
            'department_id' => 'nullable|exists:departments,id',
            'name'=>'required',
            'title'=>'nullable',
            'staff_number'=>'nullable',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'dob'=>'required',
            'phone'=>'required',
            'current_appointment'=>'nullable',
            'appointment_date'=>'nullable',
            'nin'=>'nullable',
            'tin'=>'nullable',
            'staff_number'=>'nullable',

            'date_appointed'=>'nullable',
            'salary_scale'=>'nullable',
            'salary_amount'=>'nullable',
            'allowances'=>'nullable',
            'gross_pay'=>'nullable',
            'education'=>'nullable',
            'netpay'=>'nullable',
            'duty'=>'nullable',
            'first_appointment'=>'nullable',
            'date_first_appointment'=>'nullable',
            'appointment_status'=>'nullable',
            'password'=>'required',
        ];
    }
}
