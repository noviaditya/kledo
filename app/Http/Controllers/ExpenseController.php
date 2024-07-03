<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApproveExpenseRequest;
use App\Http\Requests\StoreExpenseRequest;
use App\Repositories\ExpenseRepository;

class ExpenseController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/expense/",
     *     operationId="postExpense",
     *     tags={"Expense"},
     *     summary="Create new expense",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"amount"},
     *             @OA\Property(property="amount", type="number", example=150000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success create expense",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     )
     * )
     */
    public function store(StoreExpenseRequest $request)
    {
        $input      = $request->validated();
        $expense    = new ExpenseRepository();
        $result     = $expense->store($input);

        return response()->json($result['data'], $result['code']);
    }


    /**
     * @OA\Patch(
     *     path="/api/expense/{id}/approve",
     *     operationId="patchExpenseApproval",
     *     tags={"Expense"},
     *     summary="Update expense to be approved",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="The ID of the expense to update"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"approver_id"},
     *             @OA\Property(property="approver_id", type="number", example=2)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully approve expense",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Expense not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Invalid approver_id. Please follow approver stage order."
     *     )
     * )
     */
    public function approve($id, ApproveExpenseRequest $request)
    {
        $input          = $request->validated();
        $expense        = new ExpenseRepository();
        $result         = $expense->approve($id, $input);

        return response()->json($result['data'], $result['code']);
    }


    /**
     * @OA\Get(
     *     path="/api/expense/{id}",
     *     operationId="getExpenseById",
     *     tags={"Expense"},
     *     summary="Get Expense",
     *     @OA\Response(
     *         response=200,
     *         description="Successfully get expense",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="number"),
     *             @OA\Property(property="amount", type="number"),
     *             @OA\Property(property="status", type="object"),
     *             @OA\Property(property="approval", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No approval stages found"
     *     )
     * )
     */
    public function show($id)
    {
        $expense        = new ExpenseRepository();
        $result         = $expense->show($id);

        return response()->json($result['data'], $result['code']);
    }
}
