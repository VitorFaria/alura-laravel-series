@extends('layouts.app')

@section('content')
<x-layout title="Temporadas de {!! $series->title !!}" :success-message="$successMessage" :error-message="$errorMessage">
  @if(!empty($series->cover))
    <div class="d-flex justify-center">
      <img src="{{ asset('storage/' .$series->cover)}}" 
        alt="Capa da série" 
        class="img-fluid"
        style="height:400px"
      >
    </div>
  @endif
  <ul class="list-group">
      @foreach ($seasons as $season)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('episodes.index', $season->id) }}">
                Temporada {{ $season->number }}
            </a>   

            <span class="badge bg-secondary">
                {{ $season->countEpisodesWatched() }} / {{$season->episodes->count() }}
            </span>
        </li>
      @endforeach
  </ul>
</x-layout>
@endsection
