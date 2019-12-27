<?php

namespace App;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassificationIncident extends Model
{
    use SoftDeletes;

    public $table = 'classification_incidents';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'code',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];

}
