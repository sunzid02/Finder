<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\TestEvent' => [
            'App\Listeners\TestListener',
            'App\Listeners\TestListener2',
            'App\Listeners\TestListener3',
        ],

        'App\Events\CurrentLocationEvent' => [
            'App\Listeners\CurrentLocationListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
