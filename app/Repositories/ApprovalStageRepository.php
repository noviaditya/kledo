<?php

namespace App\Repositories;

use App\Models\ApprovalStage;

class ApprovalStageRepository
{
    public function store($data)
    {
        try {
            $created = ApprovalStage::create($data);
            return [
                'code'  => 200,
                'data'  => [
                    'message'   => 'Create approval stage success.',
                    'data'      => $created
                ]
            ];
        } catch (\Exception $e) {
            return [
                'code'  => 400,
                'data'  => [
                    'message'   => 'Create approval stage failed.'
                ]
            ];
        }
    }

    public function update($id, $data)
    {
        try {
            $approval_stage = ApprovalStage::findOrFail($id);
            $approval_stage->update($data);
            return [
                'code'  => 200,
                'data'  => [
                    'message'   => 'Update approval stage success.',
                    'data'      => $approval_stage
                ]
            ];
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return [
                'code'  => 404,
                'data'  => [
                    'message'   => 'Approval stage not found.'
                ]
            ];
        } catch (\Exception $e) {
            return [
                'code'  => 500,
                'data'  => [
                    'message'   => 'Update approval stage failed.'
                ]
            ];
        }
    }
}
