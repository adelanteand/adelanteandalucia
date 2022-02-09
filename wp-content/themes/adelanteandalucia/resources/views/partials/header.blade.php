<header class="c-header">
  <?php the_custom_logo(); ?>
  @if (has_nav_menu('primary_navigation'))
    <a href="#" class="c-header__menu-toggle js-menu-toggle">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="text">{{ esc_html__('Menú', 'adelanteandalucia') }}</span>
    </a>
    <nav class="nav-primary js-menu">
      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'container' => false]) !!}
    </nav>
  @endif
</header>
