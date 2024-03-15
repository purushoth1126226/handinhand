<?php

namespace App\Models\Admin\Patients;

use App\Models\Admin\Master\Allergy;
use App\Models\Admin\Master\Diagnosis;
use App\Models\Admin\Master\Illness;
use App\Models\Admin\Master\Labinvestigation;
use App\Models\Admin\Master\Physicalandgeneralexamination;
use App\Models\Admin\Master\Village;
use App\Models\Admin\Patients\Doctorprescription;
use App\Models\Admin\Patients\Labreport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Vital extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    // Allergy
    public function allergy()
    {
        return $this->belongsToMany(Allergy::class)->withTimestamps();
    }

    public function getAllergySelectAttribute()
    {
        return $this->allergy->pluck('id');
    }

    // Illness
    public function illness()
    {
        return $this->belongsToMany(Illness::class)->withTimestamps();

    }

    public function getIllnessSelectAttribute()
    {
        return $this->illness->pluck('id');
    }

    // Physicalandgeneralexamination
    public function physicalandgeneralexamination()
    {
        return $this->belongsToMany('App\Models\Admin\Master\Physicalandgeneralexamination', 'physicalexam_vital')->withTimestamps();
    }

    public function getPhysicalandgeneralexaminationSelectAttribute()
    {
        return $this->physicalandgeneralexamination->pluck('id');
    }

    // Diagnosis
    public function diagnosis()
    {
        return $this->belongsToMany(Diagnosis::class)->withTimestamps();
    }

    public function getDiagnosisSelectAttribute()
    {
        return $this->diagnosis->pluck('id');
    }

    // Labinvestigation
    public function labinvestigation()
    {
        return $this->belongsToMany(Labinvestigation::class)->withTimestamps();
    }

    public function getLabinvestigationSelectAttribute()
    {
        return $this->labinvestigation->pluck('id');
    }

    public function labreport()
    {
        return $this->hasMany(Labreport::class);
    }

    public function doctorprescription()
    {
        return $this->hasMany(Doctorprescription::class);
    }

}
