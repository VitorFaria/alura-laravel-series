@component('mail::message')

# {{ $seriesTitle }} criada

A série {{ $seriesTitle }} com {{ $seasonQuantity }} e {{ $episodesPerSeason}} episódios por temporada foi criada com sucesso.

Acesse aqui

@component('mail::button', ['url' => route('seasons.index', $seriesId )])
Visualizar série
@endcomponent

@endcomponent