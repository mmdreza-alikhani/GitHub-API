<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repository
{
    use HasFactory, SoftDeletes;
    protected $table = 'repositories';
    protected $fillable = [
        'user_id',
        'repository_id',
        'name',
        'language',
        'url',
        'description',
    ];

}
