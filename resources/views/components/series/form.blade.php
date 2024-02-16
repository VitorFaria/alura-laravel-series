@extends('layouts.app')

@section('content')
<form action="{{ $action }}" method="post">
  @csrf

  @isset($title)
    @method('PUT')
  @endisset
  <div class="mb-3">
      <label for="nome" class="form-label">Nome:</label>
      <input type="text"
             id="title"
             name="title"
             class="form-control"
             @isset($title)value="{{ $title }}"@endisset>
  </div>

  <button type="submit" class="btn btn-primary">
    Salvar alterações
  </button>
</form>
@endsection