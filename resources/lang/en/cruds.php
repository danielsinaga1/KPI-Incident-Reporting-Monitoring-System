<?php

return [
    'userManagement'        => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'            => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Title',
            'title_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'role'                  => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Title',
            'title_helper'       => '',
            'permissions'        => 'Permissions',
            'permissions_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
    'user'                  => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Name',
            'name_helper'              => '',
            'npk'                      => 'NPK',
            'npk_helper'               => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => '',
            'password'                 => 'Password',
            'password_helper'          => '',
            'role'                    => 'Role',
            'roles_helper'             => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
            'department'               => 'Department',
            'department_helper'        => '',
        ],
    ],
    'incidentReportSetting' => [
        'title'          => 'Incident Report Settings',
        'title_singular' => 'Incident Report Setting',
    ],
    'incidentReport'        => [
        'title'          => 'Incident Reports',
        'title_singular' => 'Incident Report',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'nama_pelapor'             => 'Nama Pelapor',
            'nama_pelapor_helper'      => '',
            'perbaikan'                => 'Perbaikan',
            'perbaikan_helper'         => '',
            'pencegahan'               => 'Pencegahan',
            'pencegahan_helper'        => '',
            'result'                   => 'Result',
            'result_helper'            => '',
            'dept_action'              => 'Tindakan Oleh',
            'dept_action_helper'       => '',
            'action_by'                => 'Actioned By',
            'action_by_helper'         => '',
            'reviewed_by'              => 'Reviewed By',
            'reviewed_by_helper'       => '',
            'acknowledge_by'           => 'Acknowledged By',
            'acknowledge_by_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
            'dept_origin'              => 'Departemen Asal',
            'dept_origin_helper'       => '',
            'location'                 => 'Lokasi Kejadian',
            'location_helper'          => '',
            'date_incident'            => 'Tanggal Kejadian',
            'date_incident_helper'     => '',
            'date_dept_action'         => 'Tanggal Perbaikan',
            'date_dept_action_helper'  => '',
            'dept_designation'         => 'Departemen Terkait',
            'dept_designation_helper'  => '',
            'team'                     => 'Team',
            'team_helper'              => '',
            'root_cause'               => 'Akar Masalah',
            'root_cause_helper'        => '',
        ],
    ],

    'classificationDetail'      => [
        'title'          => 'Classification Details',
        'title_singular' => 'Classification Detail',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Name',
            'name_helper'        => '',
            'category'           => 'Category',
            'type_helper'        => '',
            'description'        => 'Description',
            'description_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],

    'classificationIncident'      => [
        'title'          => 'Classification Incidents',
        'title_singular' => 'Classification Incident',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Name',
            'name_helper'        => '',
            'code'               => 'Code',
            'code_helper'        => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
    
    'categoryIncident'      => [
        'title'          => 'Category Incidents',
        'title_singular' => 'Category Incident',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Name',
            'name_helper'        => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
    'assetManagement'       => [
        'title'          => 'Asset management',
        'title_singular' => 'Asset management',
    ],
    'assetCategory'         => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
        ],
    ],
    'assetLocation'         => [
        'title'          => 'Locations',
        'title_singular' => 'Location',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
        ],
    ],
    'assetStatus'           => [
        'title'          => 'Statuses',
        'title_singular' => 'Status',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
        ],
    ],
    'asset'                 => [
        'title'          => 'Assets',
        'title_singular' => 'Asset',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => '',
            'category'             => 'Category',
            'category_helper'      => '',
            'serial_number'        => 'Serial Number',
            'serial_number_helper' => '',
            'name'                 => 'Name',
            'name_helper'          => '',
            'photos'               => 'Photos',
            'photos_helper'        => '',
            'status'               => 'Status',
            'status_helper'        => '',
            'location'             => 'Location',
            'location_helper'      => '',
            'notes'                => 'Notes',
            'notes_helper'         => '',
            'assigned_to'          => 'Assigned to',
            'assigned_to_helper'   => '',
            'created_at'           => 'Created at',
            'created_at_helper'    => '',
            'updated_at'           => 'Updated At',
            'updated_at_helper'    => '',
            'deleted_at'           => 'Deleted At',
            'deleted_at_helper'    => '',
        ],
    ],
    'assetsHistory'         => [
        'title'          => 'Assets History',
        'title_singular' => 'Assets History',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => '',
            'asset'                => 'Asset',
            'asset_helper'         => '',
            'status'               => 'Status',
            'status_helper'        => '',
            'location'             => 'Location',
            'location_helper'      => '',
            'assigned_user'        => 'Assigned User',
            'assigned_user_helper' => '',
            'created_at'           => 'Created at',
            'created_at_helper'    => '',
            'updated_at'           => 'Updated At',
            'updated_at_helper'    => '',
        ],
    ],
    'department'                  => [
        'title'          => 'Departments',
        'title_singular' => 'Department',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'cc_code'           => 'Cost Center',
            'cc_code_helper'    => '',
        ],
    ],
    'rootCause'             => [
        'title'          => 'Root Cause',
        'title_singular' => 'Root Cause',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'root_cause'        => 'Root Cause',
            'root_cause_helper' => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'dept_designation'   => [
        'title'          => 'Designation Departments',
        'title_singular' => 'Designation Department',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'cc_code'                  => 'Cost Center',
            'cc_code_helper'           => '',
            'name'                     => 'Department Name',
            'name_helper'              => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
        ],
    ],

    'result'                  => [
        'title'          => 'Results',
        'title_singular' => 'Result',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
        ],
    ],

    'myIncidentReport'        => [
        'title'          => 'My Incident Reports',
        'title_singular' => 'My Incident Report',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'no_laporan'               => 'Nomor Laporan',
            'no_laporan_helper'        => '',
            'nama_pelapor'             => 'Nama Pelapor',
            'nama_pelapor_helper'      => '',
            'perbaikan'                => 'Perbaikan',
            'perbaikan_helper'         => '',
            'pencegahan'               => 'Pencegahan',
            'pencegahan_helper'        => '',
            'photos'                   => 'Photos',
            'photos_helper'            => '',
            'result'                   => 'Result',
            'result_helper'            => '',
            'dept_action'              => 'Tindakan Oleh',
            'dept_action_helper'       => '',
            'action_by'                => 'Actioned By',
            'action_by_helper'         => '',
            'reviewed_by'              => 'Reviewed By',
            'reviewed_by_helper'       => '',
            'acknowledge_by'           => 'Acknowledged By',
            'acknowledge_by_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
            'dept_origin'              => 'Departemen Asal',
            'dept_origin_helper'       => '',
            'location'                 => 'Lokasi Kejadian',
            'location_helper'          => '',
            'date_incident'            => 'Tanggal Kejadian',
            'date_incident_helper'     => '',
            'date_dept_action'         => 'Tanggal Perbaikan',
            'date_dept_action_helper'  => '',
            'dept_designation'         => 'Departemen Terkait',
            'dept_designation_helper'  => '',
            'team'                     => 'Team',
            'team_helper'              => '',
            'root_cause'               => 'Akar Masalah',
            'root_cause_helper'        => '',
        ],
    ],

    'taskIncidentReport'        => [
        'title'          => 'Task Incident Reports',
        'title_singular' => 'Task Incident Report',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'nama_pelapor'             => 'Nama Pelapor',
            'nama_pelapor_helper'      => '',
            'no_laporan'               => 'Nomor Laporan',
            'no_laporan_helper'        => '',
            'perbaikan'                => 'Perbaikan',
            'perbaikan_helper'         => '',
            'pencegahan'               => 'Pencegahan',
            'pencegahan_helper'        => '',
            'result'                   => 'Result',
            'result_helper'            => '',
            'dept_action'              => 'Tindakan Oleh',
            'dept_action_helper'       => '',
            'reviewed_by'              => 'Reviewed By',
            'reviewed_by_helper'       => '',
            'acknowledge_by'           => 'Acknowledge By',
            'acknowledge_by_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
            'dept_origin'              => 'Departemen Asal',
            'dept_origin_helper'       => '',
            'location'                 => 'Lokasi Kejadian',
            'location_helper'          => '',
            'date_incident'            => 'Tanggal Kejadian',
            'date_incident_helper'     => '',
            'date_dept_action'         => 'Tanggal Perbaikan',
            'date_dept_action_helper'  => '',
            'dept_designation'         => 'Departemen Terkait',
            'dept_designation_helper'  => '',
            'action_by'                => 'Actioned By',
            'action_by_helper'         => '',
            'team'                     => 'Team',
            'team_helper'              => '',
            'root_cause'               => 'Akar Masalah',
            'root_cause_helper'        => '',
        ],
    ],

    'profile'                  => [
        'title'          => 'Profiles',
        'title_singular' => 'Profile',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Name',
            'name_helper'              => '',
            'npk'                      => 'NPK',
            'npk_helper'               => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => '',
            'password'                 => 'Password',
            'password_helper'          => '',
            'role'                    => 'Role',
            'roles_helper'             => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
            'department'               => 'Department',
            'department_helper'        => '',
        ],
    ],
];
