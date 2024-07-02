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

    public function approvals()
    {
        return $this->hasMany(Approval::class, 'expense_id', 'id')->orderBy('approver_id', 'asc');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
