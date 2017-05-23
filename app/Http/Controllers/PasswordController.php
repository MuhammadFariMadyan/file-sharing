<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\PasswordRequest;
use Auth;
use Crypt;
use Session;
use Validator;

class PasswordController extends Controller
{

    public function form($uuid)
    {
        $file = File::whereUuid($uuid)->first();

        abort_if(empty($file), 404, 'File not found or has been deleted.');

        return view('password.form', compact('file'))
            ->withTitle('Password Verification');
    }

    public function confirm(PasswordRequest $request, $uuid)
    {
        $file = File::whereUuid($uuid)->first();

        abort_if(empty($file), 404, 'File not found or has been deleted.');

        // authorize by session
        Session::put('file.' . $file->uuid, true);

        // view file
        return redirect()
            ->route('file.view', $file->uuid);
    }

    public function setupForm($uuid)
    {
        $file = File::getByUuid($uuid);

        if ($file->user_id != Auth::id()) {
            abort(403, 'You dont\'t have permission to remove file\'s password.');
        }

        return view('password.setup-form', compact('file'))
            ->withTitle(sprintf('Setup Password for %s', $file->label));
    }

    public function setup($uuid)
    {
        $validator = Validator::make(request()->only('password'), [
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors());
        }

        $file = File::getByUuid($uuid);

        if ($file->user_id != Auth::id()) {
            abort(403, 'You dont\'t have permission to remove file\'s password.');
        }

        $file->password = password_hash(request('password'), PASSWORD_BCRYPT);
        $file->plain_password = Crypt::encrypt(request('password'));
        $file->save();

        return redirect()->route('file.view', $file->uuid);
    }

    public function remove($uuid)
    {
        $file = FIle::getByUuid($uuid);

        if ($file->user_id != Auth::id()) {
            abort(403, 'You dont\'t have permission to remove file\'s password.');
        }

        $file->password = null;
        $file->plain_password = null;
        $file->save();

        return redirect()->route('file.me');
    }
}
