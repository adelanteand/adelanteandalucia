<article @php post_class('o-section') @endphp>
  <header class="o-container o-container--small">
    <p class="c-latest-post__cats">
      {!! get_the_term_list(get_the_ID(), 'un_area', '', ' ') !!}
      {!! get_the_category_list(' ') !!}
    </p>
    <h1 class="c-title-1">{!! get_the_title() !!}</h1>
    <p class="c-post-date">{{ the_time(get_option('date_format')) }}</p>
  </header>
  <div class="c-content">
    @php the_content() @endphp
    <div class="o-section alignwide">
      {!! the_tags('<div class="c-post-tags"><span>' . __('Etiquetas: ', 'adelanteandalucia') . '</span>', ' / ', '</div>') !!}
    </div>
  </div>

  @php
  $related = new WP_Query(['post__not_in' => [$post->ID], 'posts_per_page' => 3, 'category__in' =>
  wp_get_post_categories($post->ID)]);
  @endphp
  <div class="o-section o-container">
    <header class="c-latest__header">
      <h2 class="c-latest__title c-title-2">{{ __('Podría interesarte', 'adelanteandalucia') }}</h2>
      <a href="{{ get_permalink(get_option('page_for_posts')) }}" class="c-latest__link c-button">
        @svg('icon-chevron-right.svg') {{ __('Ir a actualidad', 'adelanteandalucia') }}
      </a>
    </header>
    <section class="c-latest-posts">
      @while ($related->have_posts()) @php $related->the_post() @endphp
        @include('partials.content-latest-post')
      @endwhile
    </section>
  </div>
</article>
