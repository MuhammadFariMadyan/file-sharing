<?php

namespace App\Http\Requests\File;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
        $size = Auth::check() ? Auth::user()->size : config('file.max');

        return [
            'file' => 'required|max:' . $size,
        ];
    }
}
