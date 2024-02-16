@extends('layouts.app')

@section('content')
<form action="{{ route('series.store') }}" method="post" enctype="multipart/form-data">
  @csrf

  <div class="row mb-3">
      <div class="col-8">
          <label for="nome" class="form-label">Nome:</label>
          <input type="text"
                 autofocus
                 id="title"
                 name="title"
                 class="form-control"
                 value="{{ old('title') }}">
      </div>

      <div class="col-2">
          <label for="seasonsQty" class="form-label">Nº Temporadas:</label>
          <input type="text"
                 id="seasonsQty"
                 name="seasonsQty"
                 class="form-control"
                 value="{{ old('seasonsQty') }}">
      </div>

      <div class="col-2">
          <label for="episodesPerSeason" class="form-label">Eps / Temporada:</label>
          <input type="text"
                 id="episodesPerSeason"
                 name="episodesPerSeason"
                 class="form-control"
                 value="{{ old('episodesPerSeason') }}">
      </div>
  </div>

  <div class="row mb-3">
    <div class="col-12">
        <label for="cover">Capa</label>
        <input type="file" name="cover" id="cover" class="form-control" accept="image/git, image/jpeg, image/jpg">
    </div>
  </div>

  <button type="submit" class="btn btn-primary">Adicionar</button>
</form>
@endsection