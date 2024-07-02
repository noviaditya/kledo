<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    public $table       = 'approvals';
    public $fillable    = ['expense_id', 'approver_id', 'status_id'];
    public $hidden      = ['updated_at', 'created_at'];
}
