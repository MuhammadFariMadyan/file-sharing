<?php

namespace App\Http\Controllers;

use App\File;
use App\FileDownload;
use Auth;
use DB;
use Session;
use Storage;

class FileController extends Controller
{
    public function index()
    {
        $files = File::orderBy('created_at', 'DESC')
            ->when(request('query'), function ($query) {
                return $query->where('label', 'like', '%' . request('query') . '%');
            })
            ->whereIsPrivate(0)
            ->withCount('downloads')
            ->paginate(20);

        $files->appends(request()->all());

        return view('file.index', compact('files'))
            ->withTitle('File Catalog');
    }

    public function me()
    {
        $files = File::whereUserId(Auth::id())
            ->when(request('query'), function ($query) {
                return $query->where('label', 'LIKE', '%' . request('query') . '%');
            })
            ->withCount('downloads')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        $files->appends(request()->all());

        return view('file.me', compact('files'))
            ->withTitle('My Uploaded Files');
    }

    public function view($uuid)
    {
        $file = File::whereUuid($uuid)
            ->withCount('downloads')
            ->first();

        abort_if(empty($file), 404, 'File not found or has been deleted.');

        // confirm password?
        $authorized = Session::get('file.' . $file->uuid);
        if (!empty($file->password) and !$authorized) {
            return redirect()->route('password.form', $file->uuid);
        }

        return view('file.view', compact('file', 'imagePath'))
            ->withTitle(sprintf('Download file %s', $file->label));
    }

    public function download($uuid)
    {
        $file = File::getByUuid($uuid);

        // confirm password?
        $authorized = Session::get('file.' . $file->uuid);
        if (!empty($file->password) and !$authorized) {
            return redirect()->route('password.form', $file->uuid);
        }

        // increment total download
        FileDownload::create([
            'file_id' => $file->id,
            'user_id' => Auth::check() ? Auth::id() : null,
        ]);

        return response()->download(Storage::getDriver()
                ->getAdapter()
                ->applyPathPrefix($file->path)
        );
    }

    public function delete($uuid)
    {
        $file = File::whereUuid($uuid)->first();

        abort_if(empty($file), 404, 'File not found or has been deleted.');

        if (!Auth::check() or $file->user_id != Auth::id()) {
            abort(403, 'You don\'t have permission to delete this file.');
        }

        try {
            DB::transaction(function () use ($file) {
                // delete physical file
                Storage::delete($file->path);

                // delete download info
                FileDownload::whereFileId($file->id)->delete();

                // delete file
                $file->delete();
            });

            return redirect()->route('upload.form');
        } catch (Exception $e) {
            abort(500, $e->getMessage());
        }
    }
}
