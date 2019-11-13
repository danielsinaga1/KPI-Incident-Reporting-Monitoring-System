<?php

namespace App;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryIncident extends Model
{
    use SoftDeletes, MultiTenantModelTrait;

    public $table = 'category_incidents';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'code',
        'type',
        'team_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
