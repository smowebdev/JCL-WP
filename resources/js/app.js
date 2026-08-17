import arrowUp from '../images/arrow-down-banner-up.svg';
import arrowDown from '../images/arrow-down-banner-down.svg';
import gsap from 'gsap';
import L from 'leaflet';
import { MaptilerLayer } from '@maptiler/leaflet-maptilersdk';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse'
import AOS from 'aos';
import 'aos/dist/aos.css';
window.Alpine = Alpine;
Alpine.plugin(collapse);
Alpine.start();

import 'leaflet/dist/leaflet.css';
import '@maptiler/sdk/dist/maptiler-sdk.css';
import './components/preloader';
import './components/projects';
import './components/lightbox';

AOS.init({
  once: true,
  duration: 1200,
  easing: 'ease-out',
});
document.addEventListener('DOMContentLoaded', function () {
  // =========================================================
  // Toggle Menu - Start
  // =========================================================

  const menuToggle = document.querySelector('.menu-toggle');
  const mobileMenu = document.querySelector('.menu-mobile');
  const wechat = document.querySelector('.js-wechat');
  const wechatTrigger = document.querySelector('.js-wechat-trigger');
  const wechatQr = document.querySelector('.js-wechat-qr');

  if (wechatTrigger && wechatQr) {
    wechatTrigger.addEventListener('click', function (e) {
      if (window.innerWidth < 768) {
        e.preventDefault();
        e.stopPropagation();

        wechatQr.classList.toggle('hidden');
      }
    });
  }

  if (menuToggle && mobileMenu) {
    menuToggle.addEventListener('click', function (e) {
      e.stopPropagation();

      this.classList.toggle('active');
      mobileMenu.classList.toggle('active');

      if (!mobileMenu.classList.contains('active')) {
        if (wechatQr) {
          wechatQr.classList.add('hidden');
        }
      }
    });

    mobileMenu.addEventListener('click', function (e) {
      if (wechat && e.target.closest('.js-wechat')) {
        e.stopPropagation();
        return;
      }

      if (wechatQr) {
        wechatQr.classList.add('hidden');
      }

      e.stopPropagation();
    });

    mobileMenu.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        if (wechatQr) {
          wechatQr.classList.add('hidden');
        }

        menuToggle.classList.remove('active');
        mobileMenu.classList.remove('active');
      });
    });
  }

  document.addEventListener('click', function (e) {
    if (!mobileMenu || !e.target.closest('.menu-mobile')) {
      if (wechatQr) {
        wechatQr.classList.add('hidden');
      }

      if (menuToggle) {
        menuToggle.classList.remove('active');
      }

      if (mobileMenu) {
        mobileMenu.classList.remove('active');
      }
    }
  });

  // =========================================================
  // Toggle Menu - End
  // =========================================================

  // =========================================================
  // Hero Scroll Button - Start
  // =========================================================

  const heroScrollButton = document.querySelector('.hero-scroll-btn');
  const homeHero = document.querySelector('.home-hero');

  if (heroScrollButton && homeHero) {
    heroScrollButton.addEventListener('click', function () {
      const nextSection = homeHero.nextElementSibling;

      if (!nextSection || nextSection.tagName.toLowerCase() !== 'section') {
        return;
      }

      nextSection.scrollIntoView({
        behavior: 'smooth',
        block: 'start',
      });
    });
  }

  // =========================================================
  // Hero Scroll Button - End
  // =========================================================

  // =========================================================
  // Timeline Home Hero - GSAP - Start
  // =========================================================

  const homeHeroElement = document.querySelector('.home-hero');
  const homeHeroInner = document.querySelector('.home-hero-inner');
  const timelineYear = document.querySelector('.timeline__year');
  const heroItems = document.querySelectorAll('.hero-item');

  if (
    homeHeroElement &&
    homeHeroInner &&
    timelineYear &&
    heroItems.length &&
    typeof gsap !== 'undefined'
  ) {
    const STOP_OFFSET = 10;

    const heroItemElements = Array.from(heroItems);

    const timelinePrev = document.querySelector('.timeline__btn--prev');
    const timelineNext = document.querySelector('.timeline__btn--next');

    const floatingItems = [];

    heroItemElements.forEach(function (heroItem) {
      const floating = heroItem.querySelector('.hero-side__floating');
      const main = heroItem.querySelector('.hero-main');

      if (!floating || !main) {
        return;
      }

      floatingItems.push({
        hero: heroItem,
        floating: floating,
        main: main,
      });
    });

    function getCurrentHeroIndex() {
      const scrollY = homeHeroInner.scrollTop;

      const viewportCenter = scrollY + homeHeroInner.clientHeight / 2;

      let currentIndex = 0;

      heroItemElements.forEach(function (hero, index) {
        const heroTop = hero.offsetTop;
        const heroBottom = heroTop + hero.offsetHeight;

        if (viewportCenter >= heroTop && viewportCenter < heroBottom) {
          currentIndex = index;
        }
      });

      return currentIndex;
    }

    function updateTimelineNavigation() {
      if (!timelinePrev || !timelineNext) {
        return;
      }

      const currentIndex = getCurrentHeroIndex();
      const lastIndex = heroItemElements.length - 1;

      const hasPrevious = currentIndex > 0;
      const hasNext = currentIndex < lastIndex;

      timelinePrev.classList.toggle('hidden', !hasPrevious);

      timelineNext.classList.toggle('hidden', !hasNext);

      timelinePrev.setAttribute('aria-hidden', String(!hasPrevious));

      timelineNext.setAttribute('aria-hidden', String(!hasNext));

      timelinePrev.disabled = !hasPrevious;
      timelineNext.disabled = !hasNext;
    }

    function calculateTimeline() {
      const scrollY = homeHeroInner.scrollTop;

      gsap.set(timelineYear, {
        y: scrollY,
      });

      floatingItems.forEach(function (item) {
        const { hero, floating, main } = item;

        const heroTop = hero.offsetTop;
        const heroHeight = hero.offsetHeight;
        const heroBottom = heroTop + heroHeight;

        const floatingHeight = floating.offsetHeight;
        const floatingOriginalTop = floating.offsetTop;

        const mainTop = main.offsetTop;

        const stopTop = mainTop - floatingHeight - STOP_OFFSET;

        const maxMove = Math.max(0, stopTop - floatingOriginalTop);

        if (scrollY <= heroTop) {
          gsap.set(floating, {
            y: 0,
          });

          return;
        }

        if (scrollY >= heroBottom) {
          gsap.set(floating, {
            y: maxMove,
          });

          return;
        }

        const scrollInsideHero = scrollY - heroTop;

        const movement = Math.min(Math.max(scrollInsideHero, 0), maxMove);

        gsap.set(floating, {
          y: movement,
        });
      });
    }

    function scrollToHero(index) {
      if (index < 0 || index >= heroItemElements.length) {
        return;
      }

      const targetHero = heroItemElements[index];

      homeHeroInner.scrollTo({
        top: targetHero.offsetTop,
        behavior: 'smooth',
      });

      if (timelinePrev && timelineNext) {
        const lastIndex = heroItemElements.length - 1;

        const hasPrevious = index > 0;
        const hasNext = index < lastIndex;

        timelinePrev.classList.toggle('hidden', !hasPrevious);

        timelineNext.classList.toggle('hidden', !hasNext);

        timelinePrev.setAttribute('aria-hidden', String(!hasPrevious));

        timelineNext.setAttribute('aria-hidden', String(!hasNext));

        timelinePrev.disabled = !hasPrevious;
        timelineNext.disabled = !hasNext;
      }
    }

    function updateDesktopCursor(event) {
      if (window.matchMedia('(max-width: 1023px)').matches) {
        homeHeroInner.style.cursor = '';
        return;
      }

      const rect = homeHeroInner.getBoundingClientRect();

      const mouseY = event.clientY - rect.top;

      const currentIndex = getCurrentHeroIndex();

      const isFirstHero = currentIndex === 0;

      const isLastHero = currentIndex === heroItemElements.length - 1;

      if (isFirstHero) {
        homeHeroInner.style.cursor = `url("${arrowDown}") 32 26, auto`;

        return;
      }

      if (isLastHero) {
        homeHeroInner.style.cursor = `url("${arrowUp}") 32 26, auto`;

        return;
      }

      if (mouseY < rect.height / 2) {
        homeHeroInner.style.cursor = `url("${arrowUp}") 32 26, auto`;
      } else {
        homeHeroInner.style.cursor = `url("${arrowDown}") 32 26, auto`;
      }
    }

    homeHeroInner.addEventListener('mousemove', function (event) {
      updateDesktopCursor(event);
    });

    homeHeroInner.addEventListener('click', function (event) {
      if (window.matchMedia('(max-width: 1023px)').matches) {
        return;
      }

      if (event.target.closest('a, button')) {
        return;
      }

      const rect = homeHeroInner.getBoundingClientRect();

      const mouseY = event.clientY - rect.top;

      const currentIndex = getCurrentHeroIndex();

      const isFirstHero = currentIndex === 0;

      const isLastHero = currentIndex === heroItemElements.length - 1;

      if (isFirstHero) {
        scrollToHero(currentIndex + 1);

        return;
      }

      if (isLastHero) {
        scrollToHero(currentIndex - 1);

        return;
      }
      if (mouseY < rect.height / 2) {
        scrollToHero(currentIndex - 1);
      } else {
        scrollToHero(currentIndex + 1);
      }
    });

    if (timelinePrev) {
      timelinePrev.addEventListener('click', function (event) {
        event.preventDefault();
        event.stopPropagation();

        const currentIndex = getCurrentHeroIndex();

        if (currentIndex <= 0) {
          return;
        }

        scrollToHero(currentIndex - 1);
      });
    }

    if (timelineNext) {
      timelineNext.addEventListener('click', function (event) {
        event.preventDefault();
        event.stopPropagation();

        const currentIndex = getCurrentHeroIndex();

        const lastIndex = heroItemElements.length - 1;

        if (currentIndex >= lastIndex) {
          return;
        }

        scrollToHero(currentIndex + 1);
      });
    }

    let timelineTicking = false;

    function requestTimelineUpdate() {
      if (timelineTicking) {
        return;
      }

      timelineTicking = true;

      requestAnimationFrame(function () {
        calculateTimeline();
        updateTimelineNavigation();

        timelineTicking = false;
      });
    }

    homeHeroInner.addEventListener('scroll', function () {
      requestTimelineUpdate();
    });

    homeHeroInner.addEventListener(
      'wheel',
      function (event) {
        const deltaY = event.deltaY;

        const maxScroll =
          homeHeroInner.scrollHeight - homeHeroInner.clientHeight;

        const scrollY = homeHeroInner.scrollTop;

        const atTop = scrollY <= 0;

        const atBottom = scrollY >= maxScroll - 1;

        if (deltaY > 0 && atBottom) {
          event.preventDefault();

          window.scrollBy({
            top: deltaY,
            behavior: 'auto',
          });

          return;
        }

        if (deltaY < 0 && atTop) {
          event.preventDefault();

          window.scrollBy({
            top: deltaY,
            behavior: 'auto',
          });
        }
      },
      {
        passive: false,
      },
    );

    let timelineResizeTimer;

    window.addEventListener('resize', function () {
      clearTimeout(timelineResizeTimer);

      timelineResizeTimer = setTimeout(function () {
        calculateTimeline();
        updateTimelineNavigation();
      }, 100);
    });

    calculateTimeline();
    updateTimelineNavigation();
  }

  // =========================================================
  // Timeline Home Hero - GSAP - End
  // =========================================================

  // =========================================================
  // Counter Animation - Start
  // =========================================================

  const counterElements = document.querySelectorAll('.js-counter');

  if (counterElements.length) {
    function animateCounter(counter) {
      const target = parseInt(counter.dataset.count, 10);

      if (Number.isNaN(target)) {
        return;
      }

      const duration = 1200;
      const startTime = performance.now();

      function update(currentTime) {
        const progress = Math.min((currentTime - startTime) / duration, 1);

        const ease = 1 - Math.pow(1 - progress, 3);

        const value = Math.floor(target * ease);

        counter.textContent = value;

        if (progress < 1) {
          requestAnimationFrame(update);
        } else {
          counter.textContent = target;
        }
      }

      requestAnimationFrame(update);
    }

    const counterObserver = new IntersectionObserver(
      function (entries, observer) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) {
            return;
          }

          animateCounter(entry.target);

          observer.unobserve(entry.target);
        });
      },
      {
        threshold: 0.5,
      },
    );

    counterElements.forEach(function (counter) {
      counterObserver.observe(counter);
    });
  }

  // =========================================================
  // Counter Animation - End
  // =========================================================

  // =========================================================
  // Client Logo Marquee - Start
  // =========================================================

  const marquees = document.querySelectorAll('.client-logo-marquee');

  marquees.forEach(function (marquee) {
    const originalTrack = marquee.querySelector(':scope > .client-logo-track');

    if (!originalTrack) {
      return;
    }

    const duplicate = Math.max(3, parseInt(marquee.dataset.duplicate, 10) || 2);

    for (let i = 1; i < duplicate; i++) {
      const clone = originalTrack.cloneNode(true);

      clone.classList.add('client-logo-track-clone');

      marquee.appendChild(clone);
    }
  });

  // =========================================================
  // Client Logo Marquee - End
  // =========================================================

  // =========================================================
  // Sector Item Toggle - Start
  // =========================================================

  const sectorItems = document.querySelectorAll('.sector-item');

  sectorItems.forEach(function (item) {
    const toggle = item.querySelector('.sector-toggle');

    const content = item.querySelector('.sector-content');

    const icon = item.querySelector('.sector-icon');

    if (!toggle || !content || !icon) {
      return;
    }

    toggle.addEventListener('click', function () {
      if (window.innerWidth >= 768) {
        return;
      }

      const isOpen = content.classList.contains('is-open');

      if (isOpen) {
        content.classList.remove('is-open');

        content.classList.add('grid-rows-[0fr]');

        icon.classList.remove('rotate-180');
      } else {
        content.classList.add('is-open');

        content.classList.remove('grid-rows-[0fr]');

        icon.classList.add('rotate-180');
      }
    });
  });

  // =========================================================
  // Sector Item Toggle - End
  // =========================================================

  // =========================================================
  // Group Toggle - Start
  // =========================================================

  document.querySelectorAll('.group[data-tab]').forEach(function (group) {
    group.addEventListener('click', function () {
      this.classList.toggle('active');
    });
  });

  // =========================================================
  // Group Toggle - End
  // =========================================================

  // =========================================================
  // Button Toggle - Start
  // =========================================================

  document.querySelectorAll('.btn-toggle').forEach(function (button) {
    button.addEventListener('click', function (e) {
      e.preventDefault();

      this.classList.toggle('bg-tertiary');
      this.classList.toggle('text-white');
      this.classList.toggle('border-tertiary');
    });
  });

  // =========================================================
  // Button Toggle - End
  // =========================================================

  // =========================================================
  // Form Popup - Start
  // =========================================================

  const formPopup = document.querySelector('[data-form-popup]');

  const formContents = document.querySelectorAll('.form-content');

  const formTriggers = document.querySelectorAll('.js-form-trigger');

  const formCloses = document.querySelectorAll('.js-form-close');

  function closeFormPopup() {
    if (formPopup) {
      formPopup.classList.remove('is-open');
    }

    document.body.classList.remove('popup-form-open');
  }

  formTriggers.forEach(function (trigger) {
    trigger.addEventListener('click', function (e) {
      e.preventDefault();

      const href = this.getAttribute('href');

      if (!href || href === '#') {
        return;
      }

      const formType = href.replace(/^#/, '');

      formContents.forEach(function (content) {
        content.classList.add('hidden');
      });

      const targetForm = document.querySelector(
        `[data-form-content="${formType}"]`,
      );

      if (targetForm) {
        targetForm.classList.remove('hidden');
      }

      if (formPopup) {
        formPopup.classList.add('is-open');
      }

      document.body.classList.add('popup-form-open');
    });
  });

  formCloses.forEach(function (close) {
    close.addEventListener('click', function () {
      closeFormPopup();
    });
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      closeFormPopup();
    }
  });

  // =========================================================
  // Form Popup - End
  // =========================================================

  // =========================================================
  // Map - Start
  // =========================================================

  const mapElement = document.querySelector('#map');

  if (mapElement) {
    // MapTiler API key
    const apiKey = 'QTfFDTPWze2jdhLgnmCb';

    const lat = parseFloat(mapElement.dataset.mapLat);

    const lng = parseFloat(mapElement.dataset.mapLng);

    const zoom = parseInt(mapElement.dataset.mapZoom, 10);

    const address = mapElement.getAttribute('data-map-address');

    const map = L.map('map').setView([lat, lng], zoom);

    new MaptilerLayer({
      apiKey: apiKey,
      style: 'base-v4',
    }).addTo(map);

    const customOptions = {
      maxWidth: 250,
      minWidth: 200,
    };

    const locationIcon = L.divIcon({
      className: 'custom-location-marker',

      html: `
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="100%"
          height="100%"
          viewBox="0 0 48 48"
        >
          <path
            fill="#48b564"
            d="M35.76,26.36h0.01c0,0-3.77,5.53-6.94,9.64c-2.74,3.55-3.54,6.59-3.77,8.06C24.97,44.6,24.53,45,24,45s-0.97-0.4-1.06-0.94c-0.23-1.47-1.03-4.51-3.77-8.06c-0.42-0.55-0.85-1.12-1.28-1.7L28.24,22l8.33-9.88C37.49,14.05,38,16.21,38,18.5C38,21.4,37.17,24.09,35.76,26.36z"
          />

          <path
            fill="#fcc60e"
            d="M28.24,22L17.89,34.3c-2.82-3.78-5.66-7.94-5.66-7.94h0.01c-0.3-0.48-0.57-0.97-0.8-1.48L19.76,15c-0.79,0.95-1.26,2.17-1.26,3.5c0,3.04,2.46,5.5,5.5,5.5C25.71,24,27.24,23.22,28.24,22z"
          />

          <path
            fill="#2c85eb"
            d="M28.4,4.74l-8.57,10.18L13.27,9.2C15.83,6.02,19.69,4,24,4C25.54,4,27.02,4.26,28.4,4.74z"
          />

          <path
            fill="#ed5748"
            d="M19.83,14.92L19.76,15l-8.32,9.88C10.52,22.95,10,20.79,10,18.5c0-3.54,1.23-6.79,3.27-9.3L19.83,14.92z"
          />

          <path
            fill="#5695f6"
            d="M28.24,22c0.79-0.95,1.26-2.17,1.26-3.5c0-3.04-2.46-5.5-5.5-5.5c-1.71,0-3.24,0.78-4.24,2L28.4,4.74c3.59,1.22,6.53,3.91,8.17,7.38L28.24,22z"
          />
        </svg>
      `,

      iconSize: [48, 48],
      iconAnchor: [24, 48],
      popupAnchor: [0, -48],
    });

    L.marker([lat, lng], {
      icon: locationIcon,
    })
      .addTo(map)
      .bindPopup(address, customOptions)
      .openPopup();
  }

  // =========================================================
  // Map - End
  // =========================================================
});
