<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DesignationDepartment extends Model
{
    use SoftDeletes;

    public $table = 'dept_designations';

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
        'name',
    ];

    public function incidentReports()
    {
        return $this->hasMany(IncidentReport::class, 'dept_designated_id', 'id');
    }
}
