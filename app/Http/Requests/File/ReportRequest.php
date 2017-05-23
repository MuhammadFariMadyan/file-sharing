<?php

namespace App\Http\Requests\File;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'uuid' => 'required|exists:files,uuid',
            'message' => 'required|string',
        ];

        if (!Auth::check()) {
            $rules['name'] = 'required|string|max:50';
            $rules['email'] = 'required|email|max:100';
        }

        return $rules;
    }
}
