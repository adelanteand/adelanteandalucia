{{--
  Title: AA: Cabecera de página
  Description: Cabecera con título, subtítulo y botón de acción
  Category: layout
  Icon: heading
  Mode: preview
  SupportsAlign: false
  SupportsMode: false
  SupportsAnchor: true
  SupportsMultiple: true
--}}
<section id="{{ $block['anchor'] }}" class="c-page-header o-section o-section--header">
  <h1 class="c-page-header__title c-title-1">{{ get_field('title') }}</h1>
  @if (get_field('subtitle'))
    <div class="c-page-header__subtitle">{!! get_field('subtitle') !!}</div>
    @if (get_field('button'))
      <a target="{{ get_field('button')['target'] }}" href="{{  get_field('button')['url']  }}" class="c-button c-button--primary">
        {{ get_field('button')['title'] }}
      </a>
    @endif
  @endif
</section>
