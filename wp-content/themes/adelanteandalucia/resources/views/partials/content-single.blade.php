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
</article>
