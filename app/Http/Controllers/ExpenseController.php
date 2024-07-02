<?php

namespace App\Http\Controllers;

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
}
