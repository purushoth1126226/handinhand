<?php

namespace App\Models\Admin\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class configuration extends Model
{
    use SoftDeletes;

    protected $dates   = ['deleted_at'];
    protected $guarded = ['id'];
}
