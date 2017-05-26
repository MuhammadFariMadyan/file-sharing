<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class FileReport extends Model
{
    use Uuid;

    protected $fillable = [
        'file_id',
        'user_id',
        'name',
        'email',
        'message',
    ];

    protected $casts = [
        'file_id' => 'integer',
        'user_id' => 'integer',
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
