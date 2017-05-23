<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\UploadRequest;
use Auth;
use Crypt;
use Session;

class UploadController extends Controller
{
    public function form()
    {
        return view('upload.form')
            ->withTitle('Upload New File');
    }

    public function upload(UploadRequest $request)
    {
        // upload file first
        $path = $request->file->store('public');

        // store to database
        $file = new File;

        if (Auth::check()) {
            $file->user_id = Auth::id();
        }

        // set password
        if (!empty($request->password)) {
            $file->password = password_hash($request->password, PASSWORD_BCRYPT);
            $file->plain_password = Crypt::encrypt($request->password);
        }

        $file->label = $request->label;
        $file->description = $request->description;
        $file->path = $path;
        $file->save();

        // setup authorize access
        Session::put('file.' . $file->uuid, true);

        return redirect()
            ->route('file.view', $file->uuid);
    }
}
