<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApprovalStageRequest;
use App\Repositories\ApprovalStageRepository;
use Illuminate\Http\Request;

class ApprovalStageController extends Controller
{
    public function store(StoreApprovalStageRequest $request){
        $input          = $request->validated();
        $approval_stage = new ApprovalStageRepository();
        $result         = $approval_stage->store($input);

        return response()->json($result['data'], $result['code']);
    }
}
