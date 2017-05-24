<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $filable = [
        'uuid',
        'label',
        'password',
        'plain_password',
        'path',
        'is_private',
        'expired_at',
    ];

    protected $hidden = [
        'password',
        'plain_password',
    ];

    protected $appends = [
        'download',
        'size',
        'mime',
        'type',
    ];

    protected $dates = [
        'expired_at',
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

    public function getMimeAttribute()
    {
        return \Storage::mimeType($this->attributes['path']);
    }

    public function getTypeAttribute()
    {
        return substr(\Storage::mimeType($this->attributes['path']), 0, 5);
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

    public static function expirations()
    {
        return [
            0 => 'No expiration',
            7 => 'One week',
            14 => 'Two weeks',
            30 => 'One month',
            360 => 'One year',
        ];
    }
}
