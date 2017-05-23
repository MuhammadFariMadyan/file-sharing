<?php

return [
    'max' => env('FILE_MAX', 1000), // in kb,
    'mimes' => [
        'image/jpeg' => 'file-image-o',
        'image/jpg' => 'file-image-o',
        'image/png' => 'file-image-o',
        'image/bmp' => 'file-image-o',
        'image/gif' => 'file-image-o',

        'application/zip' => 'file-archive-o',
    ],
];
