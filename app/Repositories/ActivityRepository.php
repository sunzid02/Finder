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
        $data['match_notification'] = false;

        /*
         *  if like clickked, if there is
         *  previous dislike, it will be removed
         *
         *  if disliked pressed then it will be vice versa.
         * */
        if ($action == 'like')
        {
            if (Activity::where([
                    'name' => 'dislike',
                    'acted_on' => $userId,
                    'acted_by' => $loggedInUser->id
                ])->get()->count() == 1)
            {
                Activity::where([
                    'name' => 'dislike',
                    'acted_on' => $userId,
                    'acted_by' => $loggedInUser->id
                ])->delete();
            }

            /**
                Mutual like indication - Show a popup with a message (It's a Match!) if user like one person and
                the liked person previously likes him.
             */
            $checkMatchNotification =  $this->checkMatchNotification($action, $loggedInUser->id, $userId );

            if ( $checkMatchNotification == 1 )
            {
                $data['match_notification'] = true;
            }
        }
        else if( $action == 'dislike' )
        {
            if (Activity::where([
                    'name' => 'like',
                    'acted_on' => $userId,
                    'acted_by' => $loggedInUser->id
                ])->get()->count() == 1)
            {
                Activity::where([
                    'name' => 'like',
                    'acted_on' => $userId,
                    'acted_by' => $loggedInUser->id
                ])->delete();
            }
        }

        /*
         *
         * If no like or dislike for the clicked user, then create a like or dislike mapping
         *
        */
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
            $data['match_notification'] = false;
        }

        return $data;

    }

    private function checkMatchNotification($action, $loggedInUserId, $userId)
    {
        return Activity::where([
            'name' => $action,
            'acted_on' => $loggedInUserId,
            'acted_by' => $userId
        ])->get()->count();
    }


}