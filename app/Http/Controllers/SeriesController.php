<?php

namespace App\Http\Controllers;

use App\Events\SeriesCoverDeletedEvent;
use App\Events\SeriesCreatedEvent;
use App\Http\Requests\StoreSeriesRequest;
use App\Http\Requests\UpdateSeriesRequest;
use App\Interfaces\SeriesInterface;
use App\Models\Series;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class SeriesController extends Controller
{
    public function __construct(private SeriesInterface $seriesInterface)
    {
        $this->middleware('auth')->except('index');
    }


    public function index(): View
    {
        $series = Series::query()->orderBy('title')->get();

        $successMessage = session('message.success');
        $errorMessage   = session('message.error');

        return view('series.index')->with('series', $series)
            ->with('successMessage', $successMessage)
            ->with('errorMessage', $errorMessage);
    }

    public function create(): View
    {
        return view('series.create');
    }

    public function store(StoreSeriesRequest $request): RedirectResponse
    {
        try {
            $series = $this->seriesInterface->store($request->validated());

            SeriesCreatedEvent::dispatch(
                $series->title,
                $series->id,
                $request->seasonsQty,
                $request->episodesPerSeason
            );
            $typeMessage = "message.success";
            $message =  "Série '{$series->title}' adicionada com sucesso";
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $typeMessage = "message.error";
            $message = "Não foi possível adicionar essa série";
        }

        return to_route('series.index')
            ->with($typeMessage, $message);

    }

    public function edit(Series $series): View
    {
        return view('series.edit')->with('series', $series);
    }

    public function update(Series $series, UpdateSeriesRequest $request): RedirectResponse
    {
        try {
            $series->fill($request->validated());
            $series->save();
    
            $typeMessage = "message.success";
            $message = "Série '{$series->title}' atualizada com sucesso";
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $typeMessage = "message.error";
            $message = "Não foi possível atualizar série";
        }

        return to_route('series.index')
            ->with($typeMessage, $message);
    }

    public function destroy(Series $series): RedirectResponse
    {
        try {
            SeriesCoverDeletedEvent::dispatch($series->cover);
            $series->delete();
            
            $typeMessage = "message.success";
            $message = "Série '{$series->title}' removida com sucesso.";
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $typeMessage = "message.error";
            $message = "Não possível remover série";
        }

        return to_route('series.index')
            ->with($typeMessage, $message);
    }
}
