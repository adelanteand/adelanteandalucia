@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="o-container o-container--stretch">
      <p>{{ __('No se han encontrado resultados', 'adelanteandalucia') }}</p>
    </div>
  @endif

  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-search')
  @endwhile

  {!! get_the_posts_navigation() !!}
@endsection
