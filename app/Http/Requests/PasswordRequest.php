<?php

namespace App\Http\Requests;

use App\File;
use Crypt;
use Illuminate\Foundation\Http\FormRequest;
use Validator;

class PasswordRequest extends FormRequest
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
        $file = File::find(Crypt::decrypt(request('id')));
        abort_if(empty($file), 404, 'File not found or has been deleted.');

        Validator::extend('password_verify', function ($attribute, $value) use ($file) {
            return password_verify($value, $file->password);
        });

        return [
            'id' => 'required',
            'password' => 'required|password_verify',
        ];
    }
}
