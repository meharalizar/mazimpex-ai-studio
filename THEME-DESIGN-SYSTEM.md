# Theme design system

## Current implementation

| Element | Current value |
| --- | --- |
| Surfaces | `--jet` #000000, `--base` #050505, `--glass` #0b0b0d, `--graphite` #171717 |
| Accents | `--gold` #d4af37, `--champagne` #f3de9c, `--deep-gold` #997426, `--line` #3d3524 |
| Text | `--pearl` #f8f7f2, `--soft-white` #edebe5, `--muted` #bbb7ad |
| Typography | System UI, Apple system fallback, Segoe UI, sans-serif |
| Width and spacing | 1280px content cap, section spacing `clamp(3.3rem, 7vw, 7rem)`, 7px radius |
| Motion | 180ms ease, reduced-motion handling in CSS and particles |
| Breakpoints | 1080px and 620px theme rules. Review at 1440px, 820px and 390px |
| Buttons | Metallic gradient primary treatment and darker secondary surfaces |

## Proposed direction

Use the current gold #d4af37 sparingly for primary actions, with sample proposed surfaces #111214 for the capability strip, #ffffff and #f6f4ef for content, and #181818 for body text on light backgrounds. Confirm contrast on the selected photographs. Preserve the existing tokens until the owner approves the proposed palette. Keep a strong display scale with a system sans-serif body and generous line spacing.

| Component | Presentation requirement |
| --- | --- |
| Header and desktop navigation | Dark translucent over the hero, solid readable backing where needed, visible search and quotation actions, aligned approved logo |
| Mobile navigation | Keep the toggle control, accessible name, expanded state, focus indication and accessible submenus |
| Category and product cards | Use consistent image ratios, descriptive links, visible category names and clear action hierarchy |
| Product gallery | Keep native slider and lightbox controls, image aspect ratios and accessible labels |
| Specifications and sizing | Keep header cells, scrollable table region and native expandable size chart |
| Forms | Stack on mobile, keep associated labels, attachment guidance, visible focus and status messages |
| Footer | Preserve division links, programme navigation, business enquiry links and contrast |

Keep project-owned styling in `wp-content/themes/mazimpex/style.css`. Check keyboard and touch use, reduced motion, zoom and contrast at review widths. [Current stylesheet](theme-source/style.css)
