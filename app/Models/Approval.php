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

    public function approver()
    {
        return $this->belongsTo(Approver::class, 'approver_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Approver::class, 'status_id', 'id');
    }
}
