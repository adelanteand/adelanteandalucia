{{--
  Title: AA: Equipo
  Description: Grid con miembros del equipo (foto + nombre + cargo + enlaces sociales)
  Category: layout
  Icon: groups
  Mode: preview
  SupportsAlign: false
  SupportsMode: false
  SupportsAnchor: true
  SupportsMultiple: true
--}}
<section id="{{ $block['anchor'] }}" class="c-team o-section alignwide">
  @while (have_rows('members')) @php the_row() @endphp
    <article class="c-team__member">
      @if (get_sub_field('link')) <a class="c-team__link" href="{{ get_sub_field('link') }}"> @endif
        {!! wp_get_attachment_image(get_sub_field('photo'), 'cropped-v', false, ['class' => 'c-team__photo']) !!}
      @if (get_sub_field('link')) </a> @endif
      <div class="c-team__links">
        @if (get_sub_field('email'))
          <a class="c-team__button" target="_blank" href="mailto:{{ get_sub_field('email') }}">
            @svg('team-email.svg')
          </a>
        @endif
        @if (get_sub_field('twitter'))
          <a class="c-team__button" target="_blank" href="{{ get_sub_field('twitter') }}">
            @svg('team-twitter.svg')
          </a>
        @endif
        @if (get_sub_field('instagram'))
          <a class="c-team__button" target="_blank" href="{{ get_sub_field('instagram') }}">
            @svg('team-instagram.svg')
          </a>
        @endif
      </div>
      <h2 class="c-team__name c-title-6">
        @if (get_sub_field('link')) <a href="{{ get_sub_field('link') }}"> @endif
          {{ get_sub_field('name') }}
        @if (get_sub_field('link')) </a> @endif
      </h2>
      @if (get_sub_field('position'))
        <p class="c-team__position">{{ get_sub_field('position') }}</p>
      @endif
    </article>
  @endwhile
</section>
