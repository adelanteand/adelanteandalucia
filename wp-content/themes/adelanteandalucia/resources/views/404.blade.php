@extends('layouts.app')

@section('content')
  @if (!have_posts())
  <div class="c-content">
    <section class="c-page-header o-section">
      <h1 class="c-page-header__title c-title-1">{{ __('No se ha encontrado', 'adelanteandalucia') }}</h1>
      <div class="c-page-header__subtitle">
        <p>{{ __('Lo sentimos, la página que buscas no existe', 'adelanteandalucia') }}</p>
      </div>
      <a href="{{ site_url() }}" class="c-button c-button--primary">
        {{ __('Volver al inicio', 'adelanteandalucia') }}
      </a>
    </section>
  </div>
  @endif
@endsection
