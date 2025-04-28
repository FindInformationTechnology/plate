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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        
                // 'emirate_id' => 'required|integer|min:1',
                // 'code' => 'required|string|max:255',
                // 'number' => 'required|string|max:255',
                // 'image' => 'required|string', 
                // Consider using file validation if uploading images
                // 'length' => 'required|integer|min:1',
                // 'price' => 'required|integer|min:0',
        ];
    }
        
    
}
