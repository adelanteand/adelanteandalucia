{{--
  Title: AA: Últimas noticias
  Description: Bloque con titular, enlace y listado de noticias
  Category: layout
  Icon: editor-ol
  Mode: preview
  SupportsAlign: false
  SupportsMode: false
  SupportsAnchor: true
  SupportsMultiple: true
--}}
<section id="{{ $block['anchor'] }}" class="c-latest alignwide o-section">
  <header class="c-latest__header">
    <h2 class="c-latest__title c-title-2">{{ get_field('title') }}</h2>
    <a href="{{ get_permalink(get_option('page_for_posts')) }}" class="c-latest__link c-button">
      @svg('icon-chevron-right.svg') {{ __('Ir a ', 'adelanteandalucia') }}{{ get_field('title') }}
    </a>
  </header>
  <div class="c-latest-posts">
    @php
      $latest = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 3,
      ));
    @endphp
    @while($latest->have_posts()) @php $latest->the_post() @endphp
      @include('partials.content-latest-post')
    @endwhile
    @php wp_reset_postdata(); @endphp
  </div>
  <footer class="c-latest__footer">
    <a href="{{ get_permalink(get_option('page_for_posts')) }}" class="c-latest__link c-button">
      @svg('icon-chevron-right.svg') {{ __('Ir a ', 'adelanteandalucia') }}{{ get_field('title') }}
    </a>
  </footer>
</section>
