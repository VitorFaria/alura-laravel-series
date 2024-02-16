<?php

namespace App\Interfaces;

use App\Models\Series;

interface SeriesInterface
{
  public function store(array $data): Series;
}