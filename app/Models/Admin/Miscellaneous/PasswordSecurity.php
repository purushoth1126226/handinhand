<?php

namespace App\Models\Admin\Miscellaneous;

use Illuminate\Database\Eloquent\Model;

class PasswordSecurity extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
