<?php

namespace App\Models\Admin\Master;

use App\Models\Admin\Master\Diagnosis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Drug extends Model
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

    public function diagnosis()
    {
        return $this->belongsToMany(Diagnosis::class)->withTimestamps();
    }

    public function getDiagnosisSelectAttribute()
    {
        return $this->diagnosis->pluck('id');
    }
}
