{{--
  Title: AA: Cuadrícula de enlaces
  Description: Cuadrícula de enlaces con dos niveles texto e imagen de fondo
  Category: layout
  Icon: admin-links
  Mode: preview
  SupportsAlign: false
  SupportsMode: false
  SupportsAnchor: true
  SupportsMultiple: true
--}}
<section id="{{ $block['anchor'] }}" class="c-grid-links o-section alignwide">
  @if (get_field('title'))
    <h2 class="c-section__title">{{ get_field('title') }}</h2>
  @endif
  @if (get_field('subtitle'))
    <div class="c-section__subtitle o-container o-container--small">{!! get_field('subtitle') !!}</div>
  @endif
  <div class="c-grid-links__wrapper">
    @while (have_rows('links')) @php the_row() @endphp
      <a href="{{ get_sub_field('url') }}" class="c-grid-links__link">
        {!! wp_get_attachment_image(get_sub_field('image'), 'medium', false, ['class' => 'c-grid-links__image']) !!}
        <span class="c-grid-links__title">
          <span class="c-grid-links__pretitle">{{ get_sub_field('pretitle') }}</span>
          {{ get_sub_field('title') }}
        </span>
        @svg('icon-chevron-right.svg', 'c-grid-links__icon')
      </a>
    @endwhile
  </div>
</section>
