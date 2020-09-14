<?php

namespace App\Listeners;

use App\Events\CurrentLocationEvent;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class CurrentLocationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CurrentLocationEvent  $event
     * @return void
     */
    public function handle(CurrentLocationEvent $event)
    {
        $position = \Location::get('103.133.141.99');
//        $position = \Location::get(\Request::getClientIp());
        echo "<pre>";
        print_r($position);
        $latitude = ($position != false) ? $position->latitude : 0.00 ;
        $longitude = ($position != false) ? $position->longitude : 0.00 ;


        dd($event->loggedUser->email);

        User::where('id', Auth::user()->id)->update([
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);

        return true;
    }
}
