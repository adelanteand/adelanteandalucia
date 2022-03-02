@extends('layouts.app')

@section('content')
  <section class="c-content">
    <header class="c-posts-header alignwide o-section">
      <h1 class="c-posts-header__title c-title-3">{!! App::title() !!}</h1>

      @if (is_tax() || is_home())
        @php
          $areas = get_terms(['taxonomy' => 'un_area', 'orderby' => 'term_id', 'hide_empty' => false]);
        @endphp
        <div class="c-select c-posts-header__filter">
          <select name="" id="" class="js-filter">
            <option value="{{ get_permalink(get_option('page_for_posts')) }}" {{ is_home() ? 'selected' : '' }}>{{ __('Todas', 'adelanteandalucia') }}</option>
            @foreach ($areas as $area)
            <option value="{{ get_term_link($area) }}" {{ get_queried_object()->term_id==$area->term_id ? 'selected' : ''
              }}>{{ $area->name }}</option>
            @endforeach
          </select>
        </div>
      @else
        <a class="c-button" href="{{ get_permalink(get_option('page_for_posts')) }}">{{ __('Volver a actualidad', 'adelanteandalucia') }}</a>
      @endif
    </header>

    <div class="c-latest-posts alignwide">
      @if (is_home() && is_array(get_option('sticky_posts')))
        @php
          $sticky = new WP_Query([
            'post_type' => 'post',
            'post__in' => get_option('sticky_posts'),
            'posts_per_page' => 1,
          ])
        @endphp
        @while ($sticky->have_posts()) @php $sticky->the_post() @endphp
          @include('partials.content-featured')
        @endwhile
      @endif
    @while (have_posts()) @php the_post() @endphp
      @include('partials.content-latest-post')
    @endwhile
    </div>
  </section>
  {!! App\ungrynerd_pagination() !!}
@endsection
