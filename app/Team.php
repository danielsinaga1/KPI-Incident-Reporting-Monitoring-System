<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;

    public $table = 'teams';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'cc_code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'team_id', 'id');
    }

    public function incidentReports()
    {
        return $this->hasMany(IncidentReport::class, 'team_id', 'id');
    }

    public function categoryIncidents()
    {
        return $this->hasMany(CategoryIncident::class, 'team_id', 'id');
    }
}
