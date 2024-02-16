<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends Model
{
    use HasFactory;

    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class, 'series_id');
    }

    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }

    public function countEpisodesWatched(): int
    {
        return $this->episodes->filter(fn ($episode) => $episode->watched)->count();
    }
}
