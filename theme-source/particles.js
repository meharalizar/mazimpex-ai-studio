(() => {
  const canvas = document.querySelector('.maz-particles');
  const context = canvas?.getContext('2d');
  if (!context) return;

  // Confine ambient metallic particles strictly to dark hero pages so light content stays crisp.
  const hasHero = () =>
    document.body.classList.contains('maz-has-hero') ||
    Boolean(document.querySelector('main .maz-hero, main .hero'));

  if (!hasHero()) {
    canvas.hidden = true;
    return;
  }

  const motion = matchMedia('(prefers-reduced-motion: reduce)');
  const mouse = { x: Infinity, y: Infinity };
  const colours = ['#d4af37', '#f0d98e', '#ffffff'];
  let width = 0;
  let height = 0;
  let frame = 0;
  let previous = 0;
  let particles = [];

  function render(time) {
    if (time - previous >= 32) {
      const step = Math.min((time - previous) / 32, 2);
      previous = time;
      context.clearRect(0, 0, width, height);
      for (const particle of particles) {
        const dx = particle.x - mouse.x;
        const dy = particle.y - mouse.y;
        const distance = Math.hypot(dx, dy);
        if (distance > 0 && distance < 96) {
          const force = (1 - distance / 96) * 0.12;
          particle.vx += (dx / distance) * force;
          particle.vy += (dy / distance) * force;
        }
        particle.vx += (particle.driftX - particle.vx) * 0.035;
        particle.vy += (particle.driftY - particle.vy) * 0.035;
        particle.x = (particle.x + particle.vx * step + width + 16) % (width + 16);
        particle.y = (particle.y + particle.vy * step + height + 16) % (height + 16);
        context.globalAlpha = particle.opacity;
        context.fillStyle = particle.colour;
        context.beginPath();
        context.arc(particle.x, particle.y, particle.radius, 0, Math.PI * 2);
        context.fill();
      }
    }
    frame = requestAnimationFrame(render);
  }

  function resize() {
    const hero = document.querySelector('main .maz-hero, main .hero');
    width = innerWidth;
    height = hero ? Math.max(hero.offsetHeight, 560) : Math.min(innerHeight, 780);
    const scale = Math.min(devicePixelRatio || 1, 1.5);
    canvas.style.height = `${height}px`;
    canvas.width = Math.round(width * scale);
    canvas.height = Math.round(height * scale);
    context.setTransform(scale, 0, 0, scale, 0, 0);
    const count = width < 700 ? 14 : 26;
    particles = Array.from({ length: count }, (_, index) => {
      const driftX = (Math.random() - 0.5) * 0.34;
      const driftY = (Math.random() - 0.5) * 0.34;
      return {
        x: Math.random() * width,
        y: Math.random() * height,
        driftX,
        driftY,
        vx: driftX,
        vy: driftY,
        radius: 0.5 + Math.random() * 0.85,
        opacity: 0.08 + Math.random() * 0.16,
        colour: colours[index % colours.length],
      };
    });
  }

  function update() {
    cancelAnimationFrame(frame);
    if (!motion.matches && !document.hidden) {
      previous = performance.now();
      frame = requestAnimationFrame(render);
    } else {
      context.clearRect(0, 0, width, height);
    }
  }

  addEventListener(
    'pointermove',
    (event) => {
      if (event.pointerType === 'mouse' && !motion.matches) {
        mouse.x = event.clientX;
        mouse.y = event.clientY + window.scrollY;
      }
    },
    { passive: true }
  );
  document.documentElement.addEventListener('pointerleave', () => {
    mouse.x = mouse.y = Infinity;
  });
  addEventListener('resize', resize, { passive: true });
  document.addEventListener('visibilitychange', update);
  motion.addEventListener('change', update);
  resize();
  update();
})();
