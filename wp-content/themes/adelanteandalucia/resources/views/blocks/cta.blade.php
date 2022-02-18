{{--
  Title: AA: Banner
  Description: Banner con imagen, titular, texto y enlace
  Category: layout
  Icon: star-filled
  Mode: preview
  SupportsAlign: false
  SupportsMode: false
  SupportsAnchor: true
  SupportsMultiple: true
--}}
<section id="{{ $block['anchor'] }}" class="c-cta o-section alignfull">
  <div class="c-cta__wrapper">
    <picture class="c-cta__image-wrapper">
      <source media="(min-width: 1024px)" srcset="{{ wp_get_attachment_image_url(get_field('image'), 'large') }}">
      {!! wp_get_attachment_image(get_field('image_mobile'), 'large', false, ['class' => 'c-cta__image' ]) !!}
    </picture>
    <h2 class="c-cta__title c-title-2">{{ get_field('title') }}</h2>
    <div class="c-cta__text">
      @svg('deco.svg', 'c-cta__shape')
      @svg('deco-d.svg', 'c-cta__shape c-cta__shape--d')
      {!! get_field("text") !!}
      @if (get_field('button'))
        <p>
          <a target="{{ get_field('button')['target'] }}" href="{{  get_field('button')['url']  }}" class="c-button">
            @svg('icon-chevron-right.svg') {{ get_field('button')['title'] }}
          </a>
        </p>
      @endif
    </div>
  </div>
</section>
