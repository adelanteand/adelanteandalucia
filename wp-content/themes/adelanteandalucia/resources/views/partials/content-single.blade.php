<article @php post_class() @endphp>
  <header class="o-container o-container--small">
    <h1 class="c-title-1">{!! get_the_title() !!}</h1>
  </header>
  <div class="c-content">
    @php the_content() @endphp
  </div>
</article>
