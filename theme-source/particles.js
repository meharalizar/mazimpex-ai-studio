(() => {
  const canvas = document.querySelector('.maz-particles');
  const context = canvas?.getContext('2d');
  if (!context) return;

  const motion = matchMedia('(prefers-reduced-motion: reduce)');
  const mouse = { x: Infinity, y: Infinity };
  const colours = ['#d4af37', '#f3de9c', '#f8f7f2'];
  let width, height, frame = 0, previous = 0;
  let particles = [];

  function render(time) {
    if (time - previous >= 29) {
      const step = Math.min((time - previous) / 32, 2);
      previous = time;
      context.clearRect(0, 0, width, height);
      for (const particle of particles) {
        const dx = particle.x - mouse.x;
        const dy = particle.y - mouse.y;
        const distance = Math.hypot(dx, dy);
        if (distance > 0 && distance < 108) {
          const force = (1 - distance / 108) * .16;
          particle.vx += dx / distance * force;
          particle.vy += dy / distance * force;
        }
        particle.vx += (particle.driftX - particle.vx) * .035;
        particle.vy += (particle.driftY - particle.vy) * .035;
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
    width = innerWidth;
    height = innerHeight;
    const scale = Math.min(devicePixelRatio || 1, 1.5);
    canvas.width = Math.round(width * scale);
    canvas.height = Math.round(height * scale);
    context.setTransform(scale, 0, 0, scale, 0, 0);
    particles = Array.from({ length: width < 700 ? 21 : 46 }, (_, index) => {
      const driftX = (Math.random() - .5) * .46;
      const driftY = (Math.random() - .5) * .46;
      return { x: Math.random() * width, y: Math.random() * height, driftX, driftY,
        vx: driftX, vy: driftY, radius: .55 + Math.random(), opacity: .14 + Math.random() * .3,
        colour: colours[index % colours.length] };
    });
  }

  function update() {
    cancelAnimationFrame(frame);
    if (!motion.matches && !document.hidden) {
      previous = performance.now();
      frame = requestAnimationFrame(render);
    }
  }

  addEventListener('pointermove', event => {
    if (event.pointerType === 'mouse' && !motion.matches) {
      mouse.x = event.clientX;
      mouse.y = event.clientY;
    }
  }, { passive: true });
  document.documentElement.addEventListener('pointerleave', () => { mouse.x = mouse.y = Infinity; });
  addEventListener('resize', resize, { passive: true });
  document.addEventListener('visibilitychange', update);
  motion.addEventListener('change', update);
  resize();
  update();
})();
