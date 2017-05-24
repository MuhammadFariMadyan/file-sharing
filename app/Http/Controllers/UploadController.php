<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\File\SaveRequest;
use App\Http\Requests\File\UploadRequest;
use Auth;
use Carbon\Carbon;
use Crypt;
use File as FileManager;
use Illuminate\Http\Request;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;
use Session;

class UploadController extends Controller
{
    public function form()
    {
        return view('upload.form')
            ->withTitle('Upload New File');
    }

    public function expiration()
    {
        abort_if(!request()->ajax(), 404, 'Page not found.');

        return response()->json(File::expirations());
    }

    public function size()
    {
        $size = Auth::check() ? Auth::user()->size : config('file.max');
        return response()->json([
            'size' => $size / 1000,
            'originalSize' => $size,
        ]);
    }

    public function upload(UploadRequest $request)
    {
        try {
            $uuid = Uuid::uuid4();
        } catch (UnsatisfiedDependencyException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }

        if ($request->file('file')->isValid()) {
            $directory = sprintf('public/%s/', Carbon::now()->format('Y/m/d'));
            if (FileManager::isDirectory(storage_path($directory))) {
                FileManager::makeDirectory(storage_path($directory), 0777, true);
            }

            $path = $request->file->store($directory);

            Session::put('file', [
                'uuid' => $uuid->toString(),
                'path' => $path,
                'name' => $request->file('file')->getClientOriginalName(),
            ]);

            return response()->json([
                'uuid' => $uuid->toString(),
            ]);
        }
    }

    public function save(SaveRequest $request)
    {
        // uploaded file
        $uploaded = Session::get('file');

        $file = new File;

        if (empty($request->label)) {
            $file->label = str_limit(Session::get('file.name'));
        } else {
            $file->label = str_limit($request->label, 250);
        }

        // password manager
        if (!empty($request->password)) {
            $file->password = password_hash($request->password, PASSWORD_BCRYPT);
            $file->plain_password = Crypt::encrypt($request->password);
        }

        // expiration
        if ($request->expiration > 0) {
            $file->expired_at = Carbon::now()->addDays($request->expiration);
        }

        $file->user_id = Auth::check() ? Auth::id() : null;
        $file->uuid = Session::get('file.uuid');
        $file->path = Session::get('file.path');
        $file->is_private = (bool) $request->private;
        $file->save();

        Session::put('file.' . $file->uuid, true);

        return response()->json([
            'status' => true,
            'url' => route('file.view', $file->uuid),
        ]);
    }
}
