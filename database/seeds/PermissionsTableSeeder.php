<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'incident_report_setting_access',
            ],
            [
                'id'    => '18',
                'title' => 'incident_report_create',
            ],
            [
                'id'    => '19',
                'title' => 'incident_report_edit',
            ],
            [
                'id'    => '20',
                'title' => 'incident_report_show',
            ],
            [
                'id'    => '21',
                'title' => 'incident_report_delete',
            ],
            [
                'id'    => '22',
                'title' => 'incident_report_access',
            ],
            [
                'id'    => '23',
                'title' => 'category_incident_create',
            ],
            [
                'id'    => '24',
                'title' => 'category_incident_edit',
            ],
            [
                'id'    => '25',
                'title' => 'category_incident_show',
            ],
            [
                'id'    => '26',
                'title' => 'category_incident_delete',
            ],
            [
                'id'    => '27',
                'title' => 'category_incident_access',
            ],
            [
                'id'    => '28',
                'title' => 'asset_management_access',
            ],
            [
                'id'    => '29',
                'title' => 'asset_category_create',
            ],
            [
                'id'    => '30',
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => '31',
                'title' => 'asset_category_show',
            ],
            [
                'id'    => '32',
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => '33',
                'title' => 'asset_category_access',
            ],
            [
                'id'    => '34',
                'title' => 'asset_location_create',
            ],
            [
                'id'    => '35',
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => '36',
                'title' => 'asset_location_show',
            ],
            [
                'id'    => '37',
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => '38',
                'title' => 'asset_location_access',
            ],
            [
                'id'    => '39',
                'title' => 'asset_status_create',
            ],
            [
                'id'    => '40',
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => '41',
                'title' => 'asset_status_show',
            ],
            [
                'id'    => '42',
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => '43',
                'title' => 'asset_status_access',
            ],
            [
                'id'    => '44',
                'title' => 'asset_create',
            ],
            [
                'id'    => '45',
                'title' => 'asset_edit',
            ],
            [
                'id'    => '46',
                'title' => 'asset_show',
            ],
            [
                'id'    => '47',
                'title' => 'asset_delete',
            ],
            [
                'id'    => '48',
                'title' => 'asset_access',
            ],
            [
                'id'    => '49',
                'title' => 'assets_history_access',
            ],
            [
                'id'    => '50',
                'title' => 'team_create',
            ],
            [
                'id'    => '51',
                'title' => 'team_edit',
            ],
            [
                'id'    => '52',
                'title' => 'team_show',
            ],
            [
                'id'    => '53',
                'title' => 'team_delete',
            ],
            [
                'id'    => '54',
                'title' => 'team_access',
            ],
            [
                'id'    => '55',
                'title' => 'root_cause_create',
            ],
            [
                'id'    => '56',
                'title' => 'root_cause_edit',
            ],
            [
                'id'    => '57',
                'title' => 'root_cause_show',
            ],
            [
                'id'    => '58',
                'title' => 'root_cause_delete',
            ],
            [
                'id'    => '59',
                'title' => 'root_cause_access',
            ],
            [
                'id'    => '60',
                'title' => 'designation_department_create',
            ],
            [
                'id'    => '61',
                'title' => 'designation_department_edit',
            ],
            [
                'id'    => '62',
                'title' => 'designation_department_show',
            ],
            [
                'id'    => '63',
                'title' => 'designation_department_delete',
            ],
            [
                'id'    => '64',
                'title' => 'designation_department_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
