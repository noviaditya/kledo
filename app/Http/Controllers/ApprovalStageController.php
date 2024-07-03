<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApprovalStageRequest;
use App\Http\Requests\UpdateApprovalStageRequest;
use App\Repositories\ApprovalStageRepository;

class ApprovalStageController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/approval-stages/",
     *     operationId="postApprovalStage",
     *     tags={"ApprovalStage"},
     *     summary="Create new approval stage",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"approver_id"},
     *             @OA\Property(property="approver_id", type="number", example=10)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success create approval stage",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     )
     * )
     */
    public function store(StoreApprovalStageRequest $request)
    {
        $input          = $request->validated();
        $approval_stage = new ApprovalStageRepository();
        $result         = $approval_stage->store($input);

        return response()->json($result['data'], $result['code']);
    }

    /**
     * @OA\Put(
     *     path="/api/approval-stages/{id}",
     *     operationId="putApprovalStage",
     *     tags={"ApprovalStage"},
     *     summary="Update an existing approval stage",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="The ID of the approval stage to update"
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
     *         description="Successfully updated approval stage",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Approval stage not found"
     *     )
     * )
     */
    public function update($id, UpdateApprovalStageRequest $request)
    {
        $input          = $request->validated();
        $approval_stage = new ApprovalStageRepository();
        $result         = $approval_stage->update($id, $input);

        return response()->json($result['data'], $result['code']);
    }
}
