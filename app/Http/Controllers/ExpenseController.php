<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApproveExpenseRequest;
use App\Http\Requests\StoreExpenseRequest;
use App\Repositories\ExpenseRepository;

class ExpenseController extends Controller
{
    public function store(StoreExpenseRequest $request){
        $input      = $request->validated();
        $expense    = new ExpenseRepository();
        $result     = $expense->store($input);

        return response()->json($result['data'], $result['code']);
    }

    public function approve($id, ApproveExpenseRequest $request){
        $input          = $request->validated();
        $expense        = new ExpenseRepository();
        $result         = $expense->approve($id, $input);

        return response()->json($result['data'], $result['code']);
    }
}
