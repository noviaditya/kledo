<?php

namespace App\Repositories;

use App\Models\Approver;

class ApproverRepository
{
    public function store($data)
    {
        try {
            $created = Approver::create($data);
            return [
                'code'  => 200,
                'data'  => [
                    'status'    => true,
                    'message'   => 'Create approver success.',
                    'data'      => $created
                ]
            ];
        } catch (\Exception $e) {
            return [
                'code'  => 400,
                'data'  => [
                    'status'    => false,
                    'message'   => 'Create approver failed.'
                ]
            ];
        }
    }
}
