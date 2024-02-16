<?php

namespace Tests\Feature;

use App\Repositories\SeriesRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeriesRepositoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_when_a_series_is_created_its_seasons_and_episodes_must_also_be_created(): void
    {
        // Arrange
        $repository = $this->app->make(SeriesRepository::class);

        $data = [
            'title' => 'Series title',
            'seasonsQty' => 1,
            'episodesPerSeason' => 10
        ];

        // Act
        $repository->store($data);

        // Assert
        $this->assertDatabaseHas('series', ['title' => 'Series Title']);
        $this->assertDatabaseHas('seasons', ['number' => 1]);
        $this->assertDatabaseHas('episodes', ['number' => 10]);
    }
}
