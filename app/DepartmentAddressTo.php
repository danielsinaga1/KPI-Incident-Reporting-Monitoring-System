<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentAddressTo extends Model
{
    use SoftDeletes;

    public $table = 'department_address_tos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'cc_code',
        'created_at',
        'updated_at',
        'deleted_at',
        'dept_name_address',
    ];

    public function incidentReports()
    {
        return $this->hasMany(IncidentReport::class, 'dept_addressed_to_id', 'id');
    }
}
