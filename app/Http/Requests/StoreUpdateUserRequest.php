<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email',
            'password' => 'required|min:2|max:100',
        ];
        if($this->method() == 'PUT' && empty($this['password'])) {
            unset($rules['password']);
        }
        return $rules;
    }
}
