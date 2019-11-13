<?php

use App\CrmStatus;
use Illuminate\Database\Seeder;

class CrmStatusTableSeeder extends Seeder
{
    public function run()
    {
        $crmStatuses = [
            [
                'id'         => '1',
                'name'       => 'Lead',
                'created_at' => '2019-11-08 03:16:28',
                'updated_at' => '2019-11-08 03:16:28',
            ],
            [
                'id'         => '2',
                'name'       => 'Customer',
                'created_at' => '2019-11-08 03:16:28',
                'updated_at' => '2019-11-08 03:16:28',
            ],
            [
                'id'         => '3',
                'name'       => 'Partner',
                'created_at' => '2019-11-08 03:16:28',
                'updated_at' => '2019-11-08 03:16:28',
            ],
        ];

        CrmStatus::insert($crmStatuses);
    }
}
