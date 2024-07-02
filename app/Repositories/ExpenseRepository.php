<?php

namespace App\Repositories;

use App\Models\Expense;

class ExpenseRepository
{
    public function store($data)
    {
        try {
            $expense = Expense::create($data);
            return [
                'code'  => 200,
                'data'  => [
                    'message'   => 'Create expense success.',
                    'data'      => $expense
                ]
            ];
        } catch (\Exception $e) {
            return [
                'code'  => 400,
                'data'  => [
                    'message'   => 'Create expense failed.'
                ]
            ];
        }
    }
}
