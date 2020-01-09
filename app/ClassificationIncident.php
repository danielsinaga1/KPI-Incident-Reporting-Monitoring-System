<?php

namespace App;

use App\Traits\Auditable;
use App\CategoryIncident;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassificationIncident extends Model
{
    use SoftDeletes;

    public $table = 'classify_incidents';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function classify_incident()
    {
        return $this->hasMany(ClassificationIncident::class, 'classify_id', 'id');
    }

    
    
}
