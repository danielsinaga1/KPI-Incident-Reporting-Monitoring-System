<?php

namespace App;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncidentReport extends Model
{
    use SoftDeletes, MultiTenantModelTrait;

    public $table = 'incident_reports';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date_incident',
        'date_dept_action',
    ];

    protected $fillable = [
        'team_id',
        'location',
        'perbaikan',
        'pencegahan',
        'created_at',
        'updated_at',
        'deleted_at',
        'date_incident',
        'root_cause_id',
        'dept_origin_id',
        'reviewed_by_id',
        'nama_pelapor_id',
        'date_dept_action',
        'acknowledge_by_id',
        'dept_addressed_to_id',
    ];

    public function nama_pelapor()
    {
        return $this->belongsTo(User::class, 'nama_pelapor_id');
    }

    public function dept_origin()
    {
        return $this->belongsTo(Team::class, 'dept_origin_id');
    }

    public function getDateIncidentAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDateIncidentAttribute($value)
    {
        $this->attributes['date_incident'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function root_cause()
    {
        return $this->belongsTo(RootCause::class, 'root_cause_id');
    }

    public function getDateDeptActionAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateDeptActionAttribute($value)
    {
        $this->attributes['date_dept_action'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function dept_addressed_to()
    {
        return $this->belongsTo(DepartmentAddressTo::class, 'dept_addressed_to_id');
    }

    public function reviewed_by()
    {
        return $this->belongsTo(User::class, 'reviewed_by_id');
    }

    public function acknowledge_by()
    {
        return $this->belongsTo(User::class, 'acknowledge_by_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
