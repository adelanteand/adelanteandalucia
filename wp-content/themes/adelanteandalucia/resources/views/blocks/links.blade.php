{{--
Title: AA: Enlaces
Description: Enlaces/botones sencillos en 1 o 2 columnas
Category: layout
Icon: admin-links
Mode: preview
SupportsAlign: false
SupportsMode: false
SupportsAnchor: true
SupportsMultiple: true
--}}
<section id="{{ $block['anchor'] }}" class="c-links o-section alignwide">
  <h2 class="c-section__title">{{ get_field('title') }}</h2>
  <div class="c-links__wrapper c-links__wrapper--{{ get_field('columns') }}">
    @while (have_rows('links')) @php the_row() @endphp
      @if (get_sub_field('button'))
        <a target="{{ get_sub_field('button')['target'] }}" href="{{  get_sub_field('button')['url']  }}" class="c-button c-button--primary">
          {{ get_sub_field('button')['title'] }}
        </a>
      @endif
    @endwhile
  </div>
</section>
