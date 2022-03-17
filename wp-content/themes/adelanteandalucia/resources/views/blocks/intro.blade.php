{{--
  Title: AA: Intro
  Description: Bloque introducción con imagen y textos
  Category: layout
  Icon: admin-site
  Mode: preview
  SupportsAlign: false
  SupportsMode: false
  SupportsAnchor: true
  SupportsMultiple: true
--}}
<section id="{{ $block['anchor'] }}" class="c-intro alignfull o-section">
  {!! wp_get_attachment_image(get_field('image'), 'huge', false, ['class' => 'c-intro__image']) !!}
  @php
    $top = !get_field('text') && !get_field('button2')
  @endphp
  <div class="c-intro__wrapper o-container {{ $top ? 'c-intro__wrapper--top' : '' }}">
    <div class="c-intro__content">
      <h1 class="c-intro__title c-title-2">{{ get_field('title') }}</h1>
      <p class="c-intro__subtitle">{{ get_field('subtitle') }}</p>
      @if (get_field('button'))
        <a target="{{ get_field('button')['target'] }}" href="{{  get_field('button')['url']  }}" class="c-button">
          @svg('icon-chevron-right.svg') {{ get_field('button')['title'] }}
        </a>
      @endif
    </div>
    @if (get_field('text') || get_field('button2'))
      <div class="c-intro__text">
        {!! get_field('text') !!}

        @if (get_field('button2'))
          <p>
            <a target="{{ get_field('button2')['target'] }}" href="{{ get_field('button2')['url'] }}" class="c-button c-button--alt">
              @svg('icon-chevron-right.svg') {{ get_field('button2')['title'] }}
            </a>
          </p>
        @endif
      </div>
    @endif
  </div>
</section>
