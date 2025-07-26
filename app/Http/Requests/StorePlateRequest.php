<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlateRequest extends FormRequest
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
            'plates' => 'required|array|min:1',
            'plates.*.emirate_id' => 'required|integer|exists:emirates,id',
            'plates.*.number' => 'required|string|max:255',
            'plates.*.code_id' => 'required|string|exists:codes,id',
            'plates.*.price' => 'nullable|numeric|min:0',
        ];
    }
        
    
}
