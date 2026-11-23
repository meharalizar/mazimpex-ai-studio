(() => {
  const header = document.querySelector('.site-header');
  const toggle = document.querySelector('.nav-toggle');
  const navigation = document.querySelector('#primary-navigation');
  const desktopQuery = window.matchMedia('(min-width: 1081px)');

  // Progressive fallback if an Elementor layout inserts a hero container dynamically.
  if (document.querySelector('main .maz-hero, main .hero')) {
    document.body.classList.add('maz-has-hero');
  }

  // Transparent-to-solid header state on pages with a dark cinematic hero.
  const updateHeaderScroll = () => {
    if (!header) return;
    header.classList.toggle('is-scrolled', window.scrollY > 36);
  };
  updateHeaderScroll();
  window.addEventListener('scroll', updateHeaderScroll, { passive: true });

  // Mobile primary menu toggle (preserves aria-expanded and data-collapsed contracts).
  const setMenuState = (open) => {
    if (!toggle || !navigation) return;
    toggle.setAttribute('aria-expanded', String(open));
    navigation.dataset.collapsed = String(!open);
    header?.classList.toggle('is-menu-open', open);
  };

  if (toggle && navigation) {
    setMenuState(false);

    toggle.addEventListener('click', () => {
      const expanded = toggle.getAttribute('aria-expanded') === 'true';
      setMenuState(!expanded);
    });

    // Inject accessible submenu disclosure buttons for narrow/touch navigation.
    const parentItems = navigation.querySelectorAll('li.menu-item-has-children');
    parentItems.forEach((item, index) => {
      const link = item.querySelector(':scope > a');
      const submenu = item.querySelector(':scope > .sub-menu');
      if (!link || !submenu) return;

      if (!submenu.id) {
        submenu.id = `maz-submenu-${index + 1}`;
      }

      const button = document.createElement('button');
      button.type = 'button';
      button.className = 'submenu-toggle';
      button.setAttribute('aria-expanded', 'false');
      button.setAttribute('aria-controls', submenu.id);
      button.setAttribute('aria-label', `Toggle ${link.textContent.trim()} submenu`);
      button.innerHTML = '<span aria-hidden="true"></span>';

      item.insertBefore(button, submenu);
      item.dataset.submenuOpen = 'false';

      button.addEventListener('click', () => {
        const isOpen = button.getAttribute('aria-expanded') === 'true';
        button.setAttribute('aria-expanded', String(!isOpen));
        item.dataset.submenuOpen = String(!isOpen);
      });
    });

    // Reset mobile drawer state when resizing back to desktop.
    desktopQuery.addEventListener('change', (event) => {
      if (event.matches) {
        setMenuState(false);
      }
    });
  }

  // Close mobile menu on Escape and return focus to toggle button.
  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && toggle?.getAttribute('aria-expanded') === 'true') {
      setMenuState(false);
      toggle.focus();
    }
  });

  // Mark horizontally scrollable technical specification tables for subtle visual cueing.
  const updateScrollableTables = () => {
    document.querySelectorAll('.spec-scroll').forEach((region) => {
      const canScroll = region.scrollWidth > region.clientWidth + 2;
      region.classList.toggle('is-scrollable', canScroll);
      if (canScroll && !region.hasAttribute('tabindex')) {
        region.setAttribute('tabindex', '0');
      }
    });
  };
  updateScrollableTables();
  window.addEventListener('resize', updateScrollableTables, { passive: true });
})();
