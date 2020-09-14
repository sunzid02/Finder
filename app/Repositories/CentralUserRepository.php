<?php


namespace App\Repositories;


use App\Activity;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Location\Coordinate;
use Location\Distance\Vincenty;
use Carbon\Carbon;


class CentralUserRepository implements CentralUserRepositoryInterface
{
    //See other user list (in a table or any other simplified view) around ​ 5 KM ​ (Using geolocation
    //distance driven query)
    public function desiredUserList( $mode="notMap" )
    {
        $currentUser = Auth::user();

        $currentUserLatitude = $currentUser->latitude;
        $currentUserLongitude = $currentUser->longitude;

        $currentUserCoordinate = new Coordinate($currentUserLatitude, $currentUserLongitude); // Mauna Kea Summit


        $allUsers = DB::table('users')
                    ->select('a.*')
                    ->from('users as a')
                    ->where('a.id', '!=', $currentUser->id)
                    ->get();

//        $allUsers = DB::table('users')
//                    ->select('a.*', 'b.name as activity_name')
//                    ->from('users as a')
//                    ->leftJoin('activities as b', 'a.id', '=', 'b.acted_by')
////                    ->where('id', '=', 456)
//                    ->where('a.id', '=', $currentUser->id)
//                    ->get();

//        echo "<pre>"; print_r($allUsers); dd();
//        echo "<pre>"; print_r(User::find(4)->activities->toArray()); dd();


        $desiredUserList = [];
        $targetRange = 5;
        if (!$allUsers->isEmpty())
        {
            ////calculate distance from current user
            $i = 0;
            foreach($allUsers as $user)
            {
//                echo "<pre>";
//                print_r(User::find($user->id)->activitites);
//                die();


                $coordinate2 = new Coordinate( $user->latitude, $user->longitude );
                $calculator = new Vincenty();

                $distance = ceil($calculator->getDistance($currentUserCoordinate, $coordinate2)/1000);//calculate in km
                $user->age = Carbon::parse($user->dob)->diff(\Carbon\Carbon::now())->format('%y years');
                //                $user->age = Carbon::parse($user->dob)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days');;


                $user->distance = $distance;
                $user->profile_image_path = url('uploads/'.$user->profile_image );

                if (
                    $activity = Activity::where([
                        'acted_on' => $user->id,
                        'acted_by' => Auth::user()->id
                    ])->first()
                )
                {
                    $user->activity_name = $activity->name;
                }
                else
                {
                    $user->activity_name = 'None';
                }

                if ($mode != 'map')
                {
                    if ($distance <= $targetRange)
                    {
                        $desiredUserList[$i] = $user;
                    }

                }
                else
                {
                    if ($distance <= $targetRange)
                    {
                        $desiredUserList[$i] = (array)$user;
                    }
                }
                $i++;
            }

        }
        //        echo "<pre>";
        //        print_r($desiredUserList);
        //        die();
        //

        return array_values($desiredUserList);
    }

    public function updateCurrentLocation()
    {
        $position = \Location::get(\Request::getClientIp());
        $latitude = ($position != false) ? $position->latitude : 0.00 ;
        $longitude = ($position != false) ? $position->longitude : 0.00 ;



        User::where('id', Auth::user()->id)->update([
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);

        return true;
    }

}