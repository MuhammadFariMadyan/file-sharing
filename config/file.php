<?php

return [
    /**
     * Default quota for registered user
     */
    'default_quota' => 5000, // 5 mb

    /**
     * Default max upload size for registered user
     */
    'default_size' => 2000, // 2mb

    /**
     * Default max upload size for guest
     */
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
