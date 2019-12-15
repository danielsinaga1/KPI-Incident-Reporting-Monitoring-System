<?php

namespace App;

use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Role;
use App\UserRole;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable, HasApiTokens;

    public $table = 'users';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'team_id',
        'role_id',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
        'remember_token',
        'email_verified_at',
    ];

    public function incidentReports()
    {
        return $this->hasMany(IncidentReport::class, 'nama_pelapor_id', 'id');
    }

    public function actionIncidentReports(){
        return $this->hasMany(IncidentReport::class, 'action_by_id','id');
    }

    public function assets()
    {
        return $this->hasMany(Asset::class, 'assigned_to_id', 'id');
    }

    public function assetsHistories()
    {
        return $this->hasMany(AssetsHistory::class, 'assigned_user_id', 'id');
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class);
    // }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
    
    public function role(){
        return $this->belongsTo(Role::class,'role_id');
    }

    public function isAdmin(){
        $userRole = auth()->user()->role->id;
        if($userRole == 1) {
            return true;
        }
        return false;
    }
    public function isManager(){
        $UserRole = auth()->user()->role->id;
        if($UserRole == 6){
            return true;
        }
        return false;
    }

    public function isSupervisor(){
        $UserRole = auth()->user()->role->id;
        if($UserRole == 4){
            return true;
        }
        return false;
    }

    public function isSuperintendent(){
        $UserRole = auth()->user()->role->id;
        if($UserRole == 5){
            return true;
        }
        return false;
    }

    public function isGeneralManager(){
        $UserRole = auth()->user()->role->id;
        if($UserRole == 7){
            return true;
        }
        return false;
    }
    
    
}
