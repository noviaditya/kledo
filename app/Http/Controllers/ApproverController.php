<?php

namespace App\Http\Controllers;

use App\Repositories\ApproverRepository;
use Illuminate\Http\Request;

class ApproverController extends Controller
{

    public function addApprover(Request $request){
        $approver   = new ApproverRepository();
        $result     = $approver->store($request->input());

        return response()->json($result['data'], $result['code']);
    }
}
