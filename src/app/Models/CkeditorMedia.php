<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CkeditorMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'file_path',
        'created_at',
        'updated_at'
    ];
}
