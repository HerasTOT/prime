<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntryFormatRequest extends FormRequest
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
            'name'                      => 'required|string|max:255',
            'middle_name'               => 'nullable|string|max:255',
            'last_name'                 => 'required|string|max:255',
            'mother_last_name'          => 'nullable|string|max:255',
            'email'                     => 'required|string|email|max:255',
            'phone'                     => 'required|string|regex:/^\d{10}$/',
            'age'                       => 'required|integer|min:18|max:99',
            'birthdate'                 => 'required|date|before:today',
            'ssn'                       => 'required|numeric|regex:/^\d{9}$/',
            'skills'                    => 'nullable|array',
            'skills.*'                  => 'integer|exists:job_positions,id',
            'desires'                   => 'nullable|array',
            'desires.*'                 => 'integer|exists:job_positions,id',
            'position'                  => 'required|string|max:255',
            'company'                   => 'required|string|max:255',
            'supervisor'                => 'nullable|string|max:255',
            'address'                   => 'nullable|string|max:255',
            'company_phone'             => 'nullable|string|regex:/^\d{10}$/',
            'salary'                    => 'nullable|numeric|min:0',
            'start_date'                => 'required|date|before_or_equal:end_date',
            'end_date'                  => 'nullable|date|after_or_equal:start_date',
            'termination_reason'        => 'nullable|string|max:500',

            // Validación para archivos
            'idFront'                   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'idBack'                    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'security'                  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'selfie'                    => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'cv'                        => 'nullable|file|mimes:pdf,doc,docx,png|max:5120',
            'signature'                 => 'required|file|mimes:jpg,jpeg,png|max:1024',
        ];
    }
}
