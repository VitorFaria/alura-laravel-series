<?php

namespace App\Listeners;

use App\Events\SeriesCreatedEvent;
use App\Mail\SeriesCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailUsersAboutSeriesCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SeriesCreatedEvent $event): void
    {
        $users = User::all();
        foreach($users as $index => $user)
        {
            $mailClass = new SeriesCreated(
                $event->title,
                $event->id,
                $event->seriesSeasonsQty,
                $event->seriesEpisodesPerSeason
            );

            $delayTime = now()->addSeconds($index * 2);
            Mail::to($user)->later($delayTime, $mailClass);
        }
    }
}
