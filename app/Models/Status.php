<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public $table       = 'statuses';
    public $fillable    = ['name'];
    public $hidden      = ['updated_at', 'created_at'];
}
