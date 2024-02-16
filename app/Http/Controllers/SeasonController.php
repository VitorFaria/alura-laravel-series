<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Contracts\View\View;

class SeasonController extends Controller
{
    public function index(Series $series): View
    {
        $successMessage = session('message.success');
        $errorMessage   = session('message.error');

        $seasons = $series->seasons()->with('episodes')->get();

        return view('seasons.index', [
            'successMessage' => $successMessage,
            'errorMessage' => $errorMessage,
            'seasons' => $seasons,
            'series' => $series,
        ]);
    }
}
