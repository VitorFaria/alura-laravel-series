<?php

namespace App\Listeners;

use App\Events\SeriesCoverDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SeriesCoverDeleted implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(){}

    /**
     * Handle the event.
     */
    public function handle(SeriesCoverDeletedEvent $event): void
    {
        $coverPath = Storage::disk('local')->url($event->seriesCoverPath);

        if (!empty($coverPath)) {
            Storage::delete('public/'.$event->seriesCoverPath);

            Log::info('Imagem removida do storage com sucesso');
        }
    }
}
