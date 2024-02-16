<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EpisodeController extends Controller
{
    public function index(Season $season): View
    {
        $successMessage = session('message.success');
        $errorMessage   = session('message.error');

        return view('episodes.index', [
            'episodes' => $season->episodes,
            'successMessage' => $successMessage,
            'errorMessage' => $errorMessage,
        ]);
    }

    public function markAsWatched(Request $request, Season $season): RedirectResponse
    {
        try {
            $watchedEpisodes = $request->episodes;
    
            $season->episodes->each(function(Episode $episode) use ($watchedEpisodes) {
                $episode->watched = in_array($episode->id, $watchedEpisodes);
            });
    
            $season->push();

            $typeMessage = "message.success";
            $message = "Episódios marcados como assistidos";
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            $typeMessage = "message.error";
            $message = "Não foi possível marcar como assistido esta temporada";
        }

        return to_route('episodes.index', $season->id)
            ->with($typeMessage, $message);
    }
}
