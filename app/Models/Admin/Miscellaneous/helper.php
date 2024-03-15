<?php

namespace App\Models\Admin\Miscellaneous;

use App\Models\Admin\Miscellaneous\tracking;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class helper extends Model
{
    public static function getNextSequenceId($digit, $name, $model)
    {
        $object = $model::withTrashed()
            ->orderBy('created_at', 'desc')
            ->orderBy('sequence_id', 'desc')
            ->first();

        $lastId = (!$object) ? 0 : $object->sequence_id;

        return $insertDataTwo = array(
            'uniqid' => $name . '-' . sprintf('%0' . $digit . 'd', intval($lastId) + 1),
            'sequence_id' => $lastId + 1,
            'sys_id' => md5(uniqid(rand(), true)),
        );
    }

    public static function getNextSequenceIdVital($digit, $tokendigit, $name, $model)
    {
        $object = $model::withTrashed()
            ->orderBy('created_at', 'desc')
            ->orderBy('sequence_id', 'desc')
            ->first();

        $objecttwo = $model::withTrashed()
            ->whereDate('created_at', Carbon::today())
            ->count();

        $lastId = (!$object) ? 0 : $object->sequence_id;
        $lastIdtwo = (!$object) ? 0 : $objecttwo;

        return $insertDataTwo = array(
            'uniqid' => $name . '-' . sprintf('%0' . $digit . 'd', intval($lastId) + 1),
            'sequence_id' => $lastId + 1,
            'sys_id' => md5(uniqid(rand(), true)),
            'token_id' => sprintf('%0' . $tokendigit . 'd', intval($lastIdtwo) + 1),
        );
    }

    public static function trackmessage($trackmsg, $panel)
    {
        tracking::create(['details' => $trackmsg,
            'name' => Auth::user()->name,
            'user_id' => Auth::user()->id,
            'uuid' => Auth::user()->uuid,
            'panal' => $panel,
        ]);
    }
}
