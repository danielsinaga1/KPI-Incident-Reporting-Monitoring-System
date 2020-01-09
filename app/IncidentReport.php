<?php

namespace App;

// use App\Traits\MultiTenantModelTrait;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class IncidentReport extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait, Auditable;

    public $table = 'incident_reports';
    
    protected $appends = [
        'photos',
    ];
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
        'no_laporan',
        'status',
        'perbaikan',
        'pencegahan',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
        'date_incident',
        'root_cause_id',
        'result_id',
        'reviewed_by_id',
        'nama_pelapor_id',
        'action_by_id',
        'date_dept_action',
        'acknowledge_by_id',
        'dept_designated_id',
        'cat_id',
        'classify_id',
    ];

    public function nama_pelapor()
    {
        return $this->belongsTo(User::class, 'nama_pelapor_id');
    }

    public function dept_origin()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function dept_designation()
    {
        return $this->belongsTo(DesignationDepartment::class, 'dept_designated_id');
    }

    public function reviewed_by()
    {
        return $this->belongsTo(User::class, 'reviewed_by_id');
    }

    public function action_by(){
        return $this->belongsTo(User::class, 'action_by_id');
    }
    
    public function acknowledge_by()
    {
        return $this->belongsTo(User::class, 'acknowledge_by_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function result()
    {
        return $this->belongsTo(Result::class, 'result_id');
    }

    public function root_cause()
    {
        return $this->belongsTo(RootCause::class, 'root_cause_id');
    }

    public function classify_incident() 
    {
        return $this->belongsTo(ClassificationIncident::class, 'classify_id');
    }

    public function category_incident() 
    {
        return $this->belongsTo(CategoryIncident::class, 'cat_id');
    }
    public function getDateIncidentAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDateDeptActionAttribute($value)
    {
        $this->attributes['date_dept_action'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
    
    public function getDateDeptActionAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDateIncidentAttribute($value)
    {
        $this->attributes['date_incident'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
    public function registerMediaConversions(Media $media = null){
        $this->addMediaConversion('thumb')->width(50)->height(50);
        // $this->addMediaConversion('big_thumb')->width(50)->height(50);
    }

    public function getPhotosAttribute(){

        return $this->getMedia('photos');
        // $files->each(function ($item) {
        //     $item->url       = $item->getUrl();
        //     $item->thumbnail = $item->getUrl('thumb');
        // });

        
        // $file = $this->getMedia('photos')->last();

        // if($file) {
        //     $file->url = $file->getUrl();
        //     $file->thumbnail = $file->getUrl('thumb');
        // }
    }

    // public function getGalleryAttribute() {
    //     $files = $this->getMedia('gallery');
    //     $files->each(function ($item) {
    //         $item->url = $item->getUrl();
    //         $item->thumbnail = $item->getUrl('thumb');
    //     });

    //     return $files;
    // }
    // public function getDateDeptActionAttribute($value)
    // {
    //     return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    // }

    // public function setDateDeptActionAttribute($value)
    // {
    //     $this->attributes['date_dept_action'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    // }

    public static function getNextNumberReport(){
        $year = Carbon::now()->format('y');
        $month = Carbon::now()->format('m');
        
        $yearMonth = Carbon::now()->format('my');
        
        $lastReport = IncidentReport::orderBy('created_at','desc')->first();
        // $lastReport = DB::select('select * from incident_reports limit 1');
        if($lastReport == NULL){
            $number = 0;
        } else {
            $number = explode("-", $lastReport->no_laporan);
        }

        if($yearMonth != $number[1]) {    
        $number = 0;
        }else {
            $number = $number[2];
        }

        return sprintf('%04d', intval($number) + 1);
            
    }

   
}
