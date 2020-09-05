<?php


namespace App\Repositories;

use App\Activity;
use App\User;
use Illuminate\Support\Facades\Auth;

class ActivityRepository implements ActivityRepositoryInterface
{
    public function updateAction($action, $userId)
    {
        $loggedInUser = Auth::user();

        $activity = new Activity();

        $alreadyOccurred = $activity->alreadyOccurred($action, $userId);

        $data['action_name'] = 'like';

        if ($alreadyOccurred == 0 )
        {
            Activity::create([
                'name' => $action,
                'acted_on' => $userId,
                'acted_by' => $loggedInUser->id
            ]);

            $data['message'] = 'you '.$action. ' ' .  User::findOrFail($userId)->name;

        }
        else
        {

            $data['message'] = 'you already '.$action. ' ' .  User::findOrFail($userId)->name;

        }

        return $data;

    }


}