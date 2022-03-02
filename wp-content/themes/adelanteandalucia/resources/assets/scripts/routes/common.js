import Swiper, { Navigation, Pagination } from 'swiper/core';

export default {
  setupSuperMenu: () => {
    document.querySelectorAll('.js-menu-toggle').forEach((el) => {
      el.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        el.classList.toggle('is-active');
        document.body.classList.toggle('is-open-menu');
        document.querySelector('.js-menu').classList.toggle('is-open');
      });
    });
  },
  setupSlider: () => {
    const swiper = new Swiper('.js-slider', {
      modules: [Navigation, Pagination],
      loop: true,
      autoHeight: true,
      createElements: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: true,
    });

    return swiper;
  },
  setupFilter: () => {
    document.querySelectorAll('.js-filter').forEach(el => {
      el.addEventListener('change', () => {
        window.location = el.value;
      })
    })
  },
  init() {
    // JavaScript to be fired on all pages
    this.setupSuperMenu();
    this.setupFilter();
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
