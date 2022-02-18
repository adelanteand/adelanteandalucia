<article class="c-latest-post">
  <a href="{{ get_permalink() }}" class="c-latest-post__image">
    {!! the_post_thumbnail('cropped') !!}
  </a>
  <h2 class="c-latest-post__title c-title-6"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
  {!! the_excerpt() !!}
  <p>
    <a href="{{ get_permalink() }}" class="c-button c-button--alt">
      @svg('icon-chevron-right.svg') {{ __('Leer más', 'adelanteandalucia') }}
    </a>
  </p>
</article>
