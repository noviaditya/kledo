<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApprovalStageRequest;
use App\Http\Requests\UpdateApprovalStageRequest;
use App\Repositories\ApprovalStageRepository;

class ApprovalStageController extends Controller
{
    public function store(StoreApprovalStageRequest $request){
        $input          = $request->validated();
        $approval_stage = new ApprovalStageRepository();
        $result         = $approval_stage->store($input);

        return response()->json($result['data'], $result['code']);
    }

    public function update($id, UpdateApprovalStageRequest $request){
        $input          = $request->validated();
        $approval_stage = new ApprovalStageRepository();
        $result         = $approval_stage->update($id, $input);

        return response()->json($result['data'], $result['code']);
    }
}
