<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    use HasFactory;

    protected $table = 'short_urls';

    protected $fillable = [
        'hash',
        'url',
        'folder',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'hash' => 'string',
        'url' => 'string',
        'folder' => 'string'
    ];
}
