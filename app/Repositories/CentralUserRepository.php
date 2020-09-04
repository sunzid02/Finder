<?php


namespace App\Repositories;


use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Location\Coordinate;
use Location\Distance\Vincenty;


class CentralUserRepository implements CentralUserRepositoryInterface
{
    //See other user list (in a table or any other simplified view) around ​ 5 KM ​ (Using geolocation
    //distance driven query)
    public function desiredUserList()
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

                $user->distance = $distance;
                if ($distance <= $targetRange)
                {
                    $desiredUserList[$i] = $user;
                }

                $i++;
            }

        }
//        echo "<pre>";
//        print_r($desiredUserList);
//        die();


        return $desiredUserList;
    }
}