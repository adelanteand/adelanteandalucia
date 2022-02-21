<div class="c-content">
  <section class="c-page-header o-section">
    <h1 class="c-page-header__title c-title-1">{!! App::title() !!}</h1>
    @if (!have_posts())
    <div class="c-page-header__subtitle">
      <p>{{ __('No se han encontrado resultados', 'adelanteandalucia') }}</p>
    </div>
    <a href="{{ site_url() }}" class="c-button c-button--primary">
      {{ __('Volver al inicio', 'adelanteandalucia') }}
    </a>
    @endif
  </section>
</div>
