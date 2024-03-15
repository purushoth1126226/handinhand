<?php

namespace App\Models\Admin\Druginward;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Druginward\Inwarditem;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inward extends Model
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

   
}
