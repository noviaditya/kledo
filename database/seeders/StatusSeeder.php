<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'id'   => 1,
            'name' => 'menunggu persetujuan'
        ]);

        Status::create([
            'id'   => 2,
            'name' => 'disetujui'
        ]);
    }
}
