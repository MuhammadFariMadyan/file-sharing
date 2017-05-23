<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use Uuid;

    protected $filable = [
        'uuid',
        'label',
        'password',
        'plain_password',
        'path',
        'is_private',
    ];

    protected $hidden = [
        'password',
        'plain_password',
    ];

    protected $appends = [
        'download',
        'size',
        'extension',
        'is_image',
    ];

    protected $casts = [
        'is_private' => 'boolean',
    ];

    public function getDownloadAttribute()
    {
        return route('file.view', [$this->attributes['uuid']]);
    }

    public function getSizeAttribute()
    {
        return \Storage::size($this->attributes['path']);
    }

    public function getExtensionAttribute()
    {
        return \Storage::mimeType($this->attributes['path']);
    }

    public function getIsImageAttribute()
    {
        return substr(\Storage::mimeType($this->attributes['path']), 0, 5) == 'image';
    }

    public function downloads()
    {
        return $this->hasMany(FileDownload::class);
    }

    public function reports()
    {
        return $this->hasMany(FileReport::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getByUuid($uuid, $exception = true)
    {

        $file = self::whereUuid($uuid)->first();

        if ($exception) {
            abort_if(empty($file), 404, 'File not found or has been deleted.');
        }

        return $file;
    }
}
