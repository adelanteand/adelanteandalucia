<article class="c-latest-post">
  <a href="{{ get_permalink() }}" class="c-latest-post__image">
    {!! the_post_thumbnail('cropped') !!}
  </a>
  <p class="c-latest-post__cats">
    {!! get_the_term_list(get_the_ID(), 'un_area', '', ' ') !!}
    {!! get_the_category_list(' ') !!}
  </p>
  <h2 class="c-latest-post__title c-title-6"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
  {!! the_excerpt() !!}
  <p>
    <a href="{{ get_permalink() }}" class="c-button c-button--alt">
      @svg('icon-chevron-right.svg') {{ __('Leer más', 'adelanteandalucia') }}
    </a>
  </p>
</article>
