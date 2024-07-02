<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    public $table       = 'expenses';
    public $fillable    = ['amount', 'status_id'];
    public $hidden      = ['updated_at', 'created_at'];
}
