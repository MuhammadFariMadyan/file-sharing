<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileDownload extends Model
{
    protected $fillable = [
        'file_id',
    ];

    public function file()
    {
        return $this->hasMany(File::class);
    }
}
