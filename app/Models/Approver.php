<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approver extends Model
{
    use HasFactory;

    public $table   = 'approvers';
    public $fillable = ['name'];
    public $hidden = ['updated_at', 'created_at'];
}
