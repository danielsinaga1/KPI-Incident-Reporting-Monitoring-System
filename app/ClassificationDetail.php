<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassificationDetail extends Model
{
    use SoftDeletes;

    public $table = 'classify_details';

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
        'description',
        'cat_id',
        'classify_id',
    ];

    public function category_incident()
    {
        return $this->belongsTo(CategoryIncident::class, 'cat_id');
    }

    public function classify_incident() 
    {
        return $this->belongsTo(ClassificationIncident::class, 'classify_id');
    }
}
