{{--
  Title: AA: Perfíl de persona
  Description: Bloque para el perfil de una persona, con foto, nombre, bio, enlaces sociales, etc.
  Category: layout
  Icon: admin-users
  Mode: preview
  SupportsAlign: false
  SupportsMode: false
  SupportsAnchor: true
  SupportsMultiple: true
--}}
<section id="{{ $block['anchor'] }}" class="c-member alignwide o-section">
  <div class="c-member__info">
    @if (get_field('back'))
      <a href="{{ get_field('back') }}" class="c-member__back c-button">
        @svg('icon-chevron-left.svg') {{ __('Volver', 'adelanteandalucia') }}
      </a>
    @endif
    {!! wp_get_attachment_image(get_field('photo'), 'cropped-v', false, ['class' => 'c-team__photo']) !!}
    <div class="c-team__links">
      @if (get_field('email'))
      <a class="c-team__button" target="_blank" href="mailto:{{ get_field('email') }}">
        @svg('team-email.svg')
      </a>
      @endif
      @if (get_field('twitter'))
      <a class="c-team__button" target="_blank" href="{{ get_field('twitter') }}">
        @svg('team-twitter.svg')
      </a>
      @endif
      @if (get_field('instagram'))
      <a class="c-team__button" target="_blank" href="{{ get_field('instagram') }}">
        @svg('team-instagram.svg')
      </a>
      @endif
    </div>
  </div>
  <div class="c-member__content">
    @if (get_field('back'))
      <a href="{{ get_field('back') }}" class="c-member__back c-member__back--d c-button">
        @svg('icon-chevron-left.svg') {{ __('Volver', 'adelanteandalucia') }}
      </a>
    @endif
    <h1 class="c-member__name c-title-3">{{ get_field('name') }}</h1>
    <p class="c-member__position c-team__position">{{ get_field('position') }}</p>
    {!! get_field('bio') !!}
  </div>
</section>
