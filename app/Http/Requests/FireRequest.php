<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FireRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'x' => 'required|integer|min:1|max:10',
            'y' => 'required|integer|min:1|max:10'
        ];
    }
}
