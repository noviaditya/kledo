<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApproverRequest;
use App\Repositories\ApproverRepository;

/**
 * @OA\Info(title="Kledo Test API Documentation", version="1.0")
 */
class ApproverController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/approvers/",
     *     operationId="postApprover",
     *     tags={"Approver"},
     *     summary="Create new approver",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="John Doe")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success create approver",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean"),
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     )
     * )
     */
    public function store(StoreApproverRequest $request){
        $input      = $request->validated();
        $approver   = new ApproverRepository();
        $result     = $approver->store($input);

        return response()->json($result['data'], $result['code']);
    }
}
