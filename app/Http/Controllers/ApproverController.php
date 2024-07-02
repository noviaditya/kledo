<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApproverRequest;
use App\Repositories\ApproverRepository;

class ApproverController extends Controller
{

    public function store(StoreApproverRequest $request){
        $input      = $request->validated();
        $approver   = new ApproverRepository();
        $result     = $approver->store($input);

        return response()->json($result['data'], $result['code']);
    }
}
