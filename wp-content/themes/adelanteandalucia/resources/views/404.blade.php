@extends('layouts.app')

@section('content')
  @if (!have_posts())
    <div class="o-container o-container--stretch">
      <h1>{{ __('No se ha encontrado', 'adelanteandalucia') }}</h1>
      <p>{{ __('Lo sentimos, la página que buscas no existe', 'adelanteandalucia') }}</p>
    </div>
  @endif
@endsection
