<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return
        [
			'first_name' => 'required',
			'middle_name' => 'required',
			'last_name' => 'required',
			'email' => 'required',
			'phone' => 'required',
			'address' => 'required',
			'date_of_birth' => 'required',
			'password' => 'required',
        ];
    }
}
