<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryIncident extends Model
{
    use SoftDeletes;

    public $table = 'category_incidents';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function category_incident()
    {
        return $this->hasMany(CategoryIncident::class, 'cat_id', 'id');
    }
}
