@extends('layouts.app')

@section('content')
<x-layout title="Séries" :success-message="$successMessage" :error-message="$errorMessage">
    @auth
        <a href="{{route('series.create')}}" class="btn btn-dark mb-2">Adicionar</a>
    @endauth

    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items:center">
                <div>
                    @if(!empty($serie->cover))
                        <img src="{{ asset('storage/' . $serie->cover) }}" alt="Capa de série" width="100" class="img-thumbnail">
                    @endif
                    <a @auth href="{{ route('seasons.index', $serie->id) }}" @endauth>
                        {{ $serie->title }}
                    </a>

                </div>

            @auth
                <span class="d-flex mt-auto mb-auto">
                    <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">
                        Editar
                    </a>

                    <form action="{{route('series.destroy', $serie->id)}}" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger btn-sm">Remover</button>
                    </form>
                </span>
            @endauth
            </li>
        @endforeach
    </ul>
</x-layout>
@endsection