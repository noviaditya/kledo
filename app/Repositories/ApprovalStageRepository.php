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
                    'status'    => true,
                    'message'   => 'Create approval stage success.',
                    'data'      => $created
                ]
            ];
        } catch (\Exception $e) {
            return [
                'code'  => 400,
                'data'  => [
                    'status'    => false,
                    'message'   => 'Create approval stage failed.'
                ]
            ];
        }
    }
}
