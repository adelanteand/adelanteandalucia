<footer class="c-footer">
  <div class="c-footer__wrapper o-container">
    {!! wp_get_attachment_image(get_field('logo', 'option'), 'medium', false, ['class' => 'c-footer__logo']) !!}

    <div class="c-footer__social">
      @if (get_field('facebook', 'option'))
      <a href="{{ get_field('facebook', 'option') }}" target="_blank">
        @svg('facebook.svg')
      </a>
      @endif
      @if (get_field('twitter', 'option'))
      <a href="{{ get_field('twitter', 'option') }}" target="_blank">
        @svg('twitter.svg')
      </a>
      @endif
      @if (get_field('instagram', 'option'))
      <a href="{{ get_field('instagram', 'option') }}" target="_blank">
        @svg('instagram.svg')
      </a>
      @endif
      @if (get_field('youtube', 'option'))
      <a href="{{ get_field('youtube', 'option') }}" target="_blank">
        @svg('youtube.svg')
      </a>
      @endif
      @if (get_field('telegram', 'option'))
      <a href="{{ get_field('telegram', 'option') }}" target="_blank">
        @svg('telegram.svg')
      </a>
      @endif
    </div>

    @if (has_nav_menu('footer_navigation'))
      {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'c-footer__nav', 'container' => false]) !!}
    @endif

    <div class="c-footer__text">{!! get_field('footer_text', 'option') !!}</div>
  </div>
</footer>
