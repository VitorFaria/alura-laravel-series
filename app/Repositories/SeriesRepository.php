<?php

namespace App\Repositories;

use App\Interfaces\SeriesInterface;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class SeriesRepository implements SeriesInterface
{
  public function store(array $request): Series
  {
    return DB::transaction(function() use ($request) {
      $coverPath = !empty($request['cover']) ? $this->uploadFile($request['cover']) : null;
      $series = Series::create([
        'title' => $request['title'],
        'cover' => $coverPath,
      ]);

      $seasons = [];
      for ($i = 1; $i <= (int) $request['seasonsQty']; $i++) {
          $seasons[] = [
              'series_id' => $series->id,
              'number' => $i,
          ];
      }
      Season::insert($seasons);

      $episodes = [];
      foreach ($series->seasons as $season) {
          for ($j = 1; $j <= (int) $request['episodesPerSeason']; $j++) {
              $episodes[] = [
                  'season_id' => $season->id,
                  'number' => $j
              ];
          }
      }
      Episode::insert($episodes);

      return $series;
    });
  }

  private function uploadFile(UploadedFile $file = null)
  {
    if (!empty($file)) {
      return $file->store('series_cover', 'public');
    }
  }
}