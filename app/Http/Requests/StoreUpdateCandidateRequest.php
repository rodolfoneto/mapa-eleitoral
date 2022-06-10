<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCandidateRequest extends FormRequest
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
        $url = $this->segment(3);
        return [
            'responsibility_id' => 'required|exists:responsibilities,id',
            'name' => 'required|min:3|max:200',
            'political_party' => 'nullable',
        ];
    }
}
