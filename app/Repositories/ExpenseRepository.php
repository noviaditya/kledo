<?php

namespace App\Repositories;

use App\Exceptions\InvalidApproverException;
use App\Models\Approval;
use App\Models\ApprovalStage;
use App\Models\Expense;
use Exception;
use Illuminate\Support\Facades\DB;

class ExpenseRepository
{
    public function store($data)
    {
        try {
            DB::beginTransaction();
            $expense = Expense::create($data);
            $approval_stages = ApprovalStage::orderBy('id', 'ASC')->get();

            foreach ($approval_stages as $stage) {
                Approval::create([
                    'expense_id'    => $expense->id,
                    'approver_id'   => $stage->approver_id,
                    'status_id'     => 1,
                ]);
            }
            DB::commit();

            return [
                'code'  => 200,
                'data'  => [
                    'message'   => 'Create expense success.',
                    'data'      => $expense
                ]
            ];
        } catch (Exception $e) {
            DB::rollBack();
            return [
                'code'  => 400,
                'data'  => [
                    'message'   => 'Create expense failed.'
                ]
            ];
        }
    }

    public function approve($id, $data)
    {
        try {
            $expense = Expense::with('approvals')->findOrFail($id);

            DB::beginTransaction();

            //check expense yang harus diapprove
            $required_approval = $this->checkRequiredApproval($expense->approvals);

            //jika tidak sesuai, return validation
            if ($required_approval != $data['approver_id']) {
                throw new InvalidApproverException("Approval failed. Please follow approval stage order.");
            }

            $approval = $expense->approvals->where('approver_id', $data['approver_id'])->first();
            $approval->update(['status_id' => 2]);

            if($this->checkAllApproval($expense->id)){
                $expense->update(['status_id' => 2]);
            }

            DB::commit();

            $response = [
                'code'  => 200,
                'data'  => [
                    'message'   => 'Expense approval success.',
                    'data'      => $expense
                ]
            ];
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $response = [
                'code'  => 404,
                'data'  => [
                    'message'   => 'Expense not found.'
                ]
            ];
        } catch (InvalidApproverException $e) {
            DB::rollBack();
            $response = [
                'code'  => 422,
                'data'  => [
                    'message'   => $e->getMessage()
                ]
            ];
        } catch (Exception $e) {
            DB::rollBack();
            $response = [
                'code'  => 500,
                'data'  => [
                    'message'   => 'Expense approval failed.'
                ]
            ];
        }

        return $response;
    }

    public function checkRequiredApproval($approvals)
    {
        $valid_approver_id = 0;
        foreach ($approvals as $approval) {
            if ($approval['status_id'] == 1) {
                $valid_approver_id = $approval['approver_id'];
                break;
            }
        }

        return $valid_approver_id;
    }

    public function checkAllApproval($expense_id)
    {
        $approvals = Approval::where('expense_id', $expense_id)->get();
        foreach ($approvals as $approval) {
            if ($approval['status_id'] == 1) {
                return false;
            }
        }

        return true;
    }

    public function show($id)
    {
        try {
            $expense = Expense::with(['status', 'approvals', 'approvals.approver', 'approvals.status'])->find($id);

            if(empty($expense)){
                return [
                    'code'      => 404,
                    'data'  => [
                        'message'   => 'Expense data not found.'
                    ]
                ];
            }

            return [
                'code'  => 200,
                'data'  => [
                    'id'        => $expense->id,
                    'amount'    => $expense->amount,
                    'status'    => $expense->status,
                    'approval'  => $this->cleanApprovals($expense->approvals)
                ]
            ];
        } catch (Exception $e) {
            return [
                'code'  => 500,
                'data'  => [
                    'message'   => 'Get data expense failed.'
                ]
            ];
        }
    }

    public function cleanApprovals($approvals){
        foreach($approvals as $approval){
            unset($approval['expense_id']);
            unset($approval['approver_id']);
            unset($approval['status_id']);
        }
        return $approvals;
    }
}
