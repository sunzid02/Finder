<?php


namespace App\Repositories;


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
                    ->select('*')
//                    ->where('id', '=', 456)
                    ->where('id', '!=', $currentUser->id)
                    ->get();

        $desiredUserList = [];
        $targetRange = 5;
        if (!$allUsers->isEmpty())
        {
            ////calculate distance from current user
            $i = 0;
            foreach($allUsers as $user)
            {
                $coordinate2 = new Coordinate( $user->latitude, $user->longitude );
                $calculator = new Vincenty();

                $distance = ceil($calculator->getDistance($currentUserCoordinate, $coordinate2)/1000);//calculate in km
                $user->age = Carbon::parse($user->dob)->diff(\Carbon\Carbon::now())->format('%y years');
//                $user->age = Carbon::parse($user->dob)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days');;

                $user->distance = $distance;
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


        return $desiredUserList;
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