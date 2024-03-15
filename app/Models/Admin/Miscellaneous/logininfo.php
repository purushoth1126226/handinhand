<?php

namespace App\Models\Admin\Miscellaneous;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class logininfo extends Model
{
    use SoftDeletes;

    protected $dates   = ['deleted_at'];
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
