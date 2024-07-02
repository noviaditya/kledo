<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalStage extends Model
{
    use HasFactory;

    public $table       = 'approval_stages';
    public $fillable    = ['approver_id'];
    public $hidden      = ['updated_at', 'created_at'];
}
