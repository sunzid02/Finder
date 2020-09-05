<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = ['name', 'acted_on', 'acted_by'];

    public function alreadyOccurred($action, $userId)
    {
        $loggedUserId = Auth::user()->id;


        return Activity::where([
            'name' => $action,
            'acted_on' => $userId,
            'acted_by' => $loggedUserId
        ])->get()->count();
    }
}
