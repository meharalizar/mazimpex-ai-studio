# MAZ IMPEX WordPress Theme Redesign — Codex Integration Summary

This document summarises the proposed WordPress theme redesign prepared for integration into `wp-content/themes/mazimpex/` on a dedicated private redesign branch, following [CODEX-HANDOFF.md](../CODEX-HANDOFF.md) and [WORDPRESS-INTEGRATION.md](../WORDPRESS-INTEGRATION.md).

## 1. Visual direction & architecture

- **Hybrid industrial palette**: Retains the dark cinematic photographic hero, transparent-to-obsidian navigation header, dark `#111214` capability/feature bands, dark `#0b0c0e` architectural footer, and restrained `#d4af37` metallic-gold primary actions, while transitioning editorial, catalogue archive, single-product, and RFQ regions to crisp `#ffffff` and warm off-white `#f6f4ef` surfaces with `#141518` / `#2c2f36` typography.
- **Typography**: Pairs `Archivo` (display) with `Plus Jakarta Sans` (body) via conditional enqueue outside `local`, falling back cleanly to system sans-serif (`-apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif`) in offline `local` environments. Technical specification tables, SKUs, and size charts enforce `font-variant-numeric: tabular-nums`.
- **Four manufacturing divisions**: Structured 4-column desktop (`>= 1081px`), 2-column tablet (`621px–1080px`), and single-column mobile (`<= 620px`) grids for:
  1. Combat Sports Equipment (`combat-sports-equipment`)
  2. Combat Sportswear (`combat-sportswear`)
  3. Team Sportswear (`team-sportswear`)
  4. Custom Clothing & Activewear (`custom-clothing-activewear`)
- **Zero replacement frameworks**: All theme deliverables remain authentic WordPress PHP, semantic HTML5, CSS3 (`theme-source/style.css`), and vanilla JavaScript (`navigation.js`, `particles.js`).

## 2. Path-by-path change summary (`theme-source/`)

| File | Summary of changes | Preserved contracts |
| --- | --- | --- |
| `theme-source/style.css` | Bumped theme version to `3.0.0`. Added light-canvas design tokens (`--surface-white`, `--surface-alt`, `--surface-dark`, `--ink`, `--gold-ink`, `--border-light`) while preserving all legacy variables. Implemented transparent hero header + scrolled obsidian transition, calibrated hero scrims (desktop + mobile), dark `#111214` capability strip, 4-column divisions & WooCommerce product grids, sticky 2-column single-product gallery/summary layout, tabular specification tables & native `details.size-guide` disclosure styling, clean underline WooCommerce tabs, light-surface RFQ form styling, scoped Elementor Free Kit tokens (light default + dark band overrides), architectural footer, and `1080px` / `860px` / `620px` responsive rules. | Preserves WordPress theme header, all existing selectors (`.maz-elementor-content`, `.maz-hero`, `.maz-section`, `.maz-feature`, `.maz-conversion`, `.maz-category-grid`, `.maz-catalogue-card`, `.maz-info-card`, `.maz-review-layout`, `.spec-scroll`, `.size-guide`, `.rfq-form`), catalogue-only rules (hidden prices/cart/sorting), PhotoSwipe `.pswp` button isolation, and `prefers-reduced-motion`. |
| `theme-source/functions.php` | Added `html5` theme support; conditional Google Fonts enqueue (`mazimpex-fonts`) outside `local`; `loop_shop_columns` (`4`) and `woocommerce_output_related_products_args` (`4` items, `4` columns); `body_class` helper (`maz-theme-v3`, `maz-has-hero`, `maz-catalogue-archive`, `maz-single-product`); `maz_theme_page_has_hero()` detector; `maz_theme_divisions()` helper resolving category permalinks via `get_term_link()` with safe fallback. | Preserves all enqueue handles (`mazimpex`, `mazimpex-navigation`, `mazimpex-particles`, `mazimpex-font-awesome`), Font Awesome 6.7.2 CDN / `local` switch, Elementor FA5 bridge, WooCommerce wrapper hooks (`<main id="main" class="wrap entry ...">`), `maz_category_details()`, `wp_body_open` canvas, favicon fallback, and `maz_theme_wordmark()`. |
| `theme-source/header.php` | Added `#site-header` ID, visual menu bars span inside `.nav-toggle`, dedicated `.search-submit` icon button inside `.search-form` for touch/keyboard users, and `.header-whatsapp` class on the WhatsApp link. | Preserves `language_attributes()`, `wp_head()`, `body_class()`, `wp_body_open()`, `#main` skip-link, `has_custom_logo()` / `maz_theme_wordmark()`, `aria-controls="primary-navigation"`, `wp_nav_menu('primary')`, `post_type=product` search, `/request-a-quote/` CTA, and `maz_whatsapp()`. |
| `theme-source/footer.php` | Structured architectural multi-column footer using `maz_theme_divisions()`, preserved dynamic programme page queries, optional `footer` menu, `maz_settings()['email']`, `maz_whatsapp()`, Request a quote link, and quiet bottom legal/origin strip. | Preserves `maz_theme_wordmark()`, `maz_settings()`, `maz_whatsapp()`, division slugs, programme slugs, and `wp_footer()`. |
| `theme-source/page.php` | Wrapped non-Elementor interior page titles in `.page-header` and added a non-destructive semantic fallback when `is_front_page()` has neither an Elementor marketing layout nor editor content. | Preserves `maz_has_marketing_layout()`, `.maz-elementor-content`, local `maz_render_elementor_review()` preview, `the_content()` Elementor Free path, Full Width / Canvas compatibility, and `#main`. |
| `theme-source/index.php` | Upgraded archive/search/insights listing into clean light-surface cards (`.search-results-grid`), singular entry wrapper, and actionable empty state. | Preserves `#main`, WordPress Loop, `the_posts_pagination()`, and search discovery routes. |
| `theme-source/404.php` | Added clear recovery CTAs (`Return to the homepage`, `Request a quote`) and a 4-column grid linking to all four manufacturing divisions. | Preserves `#main` landmark, search route reference, and WordPress URL escaping. |
| `theme-source/navigation.js` | Added passive scroll listener toggling `.is-scrolled` on `.site-header`, dynamic hero fallback check for `maz-has-hero`, accessible `.submenu-toggle` buttons (`aria-expanded`, `aria-controls`) for mobile/tablet submenus, desktop resize reset, and `.spec-scroll` horizontal scroll cues. | Preserves `.nav-toggle`, `aria-expanded`, `data-collapsed`, and Escape-key focus restoration. |
| `theme-source/particles.js` | Restricted particle rendering strictly to dark hero pages (`maz-has-hero`) sized to hero height with calm low-opacity metallic motes, exiting immediately on light pages. | Preserves `.maz-particles` canvas hook, `mazimpex-particles` handle, visibility throttling, and `prefers-reduced-motion`. |

## 3. Proposed Elementor Free class & placement updates

Apply these optional class refinements in the private Core layout generator (`inc/elementor-layouts.php`) without overwriting user-edited Elementor documents:

1. **Hero container**: Keep `.maz-hero` (theme automatically activates transparent header overlay via `maz-has-hero`). Use native Heading (`h1`), Text Editor, and nested Container (`.maz-hero-actions`) with `.maz-gold-button` (Request a quote) and `.maz-secondary-button` (Explore divisions / catalogue).
2. **Manufacturing capability strip**: Apply `.maz-section .maz-feature .maz-capability-strip` to the dark obsidian strip immediately beneath the hero, containing a 4-column nested Grid/Flex container (`.maz-capability-grid`) of `.maz-info-card` containers.
3. **Four product divisions section**: Apply `.maz-section` (white canvas) with `.maz-category-grid .maz-divisions-grid` containing four `.maz-catalogue-card` containers (Combat Sports Equipment, Combat Sportswear, Team Sportswear, Custom Clothing & Activewear).
4. **Alternating white / off-white rhythm**: Apply `.maz-section .maz-section-alt` (`#f6f4ef` warm alabaster) to alternating marketing sections (such as OEM/ODM process, custom branding, or materials) to separate them cleanly from pure `#ffffff` sections.
5. **Final commercial CTA band**: Keep `.maz-section .maz-conversion` for the obsidian-and-gold bottom quotation callout.
6. **Elementor Kit global colours**: No manual database migration is required; `style.css` scopes `.maz-elementor-content .elementor[data-elementor-type]` to light ink by default and switches cleanly to pearl/champagne inside `.maz-hero`, `.maz-feature`, `.maz-capability-strip`, `.maz-conversion`, `.dark`, and `.maz-opaque`.

## 4. Asset requirements & exclusions for Codex

- **Copy ONLY `theme-source/`** into `wp-content/themes/mazimpex/` on the private redesign branch.
- **Keep private production assets**: Do not overwrite the private repository's approved logo (`assets/brand/maz-logo-header.webp`), favicon (`assets/brand/favicon.png`), launch hero photographs (`assets/maz-gold-hero.webp`, `assets/maz-gold-hero-mobile.webp`), or bundled Font Awesome 6.7.2 package (`assets/vendor/fontawesome/`).
- **Do NOT copy AI Studio review scaffolding into WordPress**: `package.json`, `reference-previews/index.html`, `reference-previews/category-archive.html`, `reference-previews/single-product.html`, `reference-previews/preview-server.mjs`, and `reference-previews/verify-theme.mjs` exist solely for static design review in AI Studio's Node.js preview sandbox.

## 5. Verification limits & Codex validation checklist

**Environment limitation**: Google AI Studio runs Node.js only and does **not** include PHP 8.3, WordPress, WooCommerce, Elementor Free, Rank Math SEO, WP Mail SMTP, or MAZ IMPEX Core. Therefore:
- Static checks verified vanilla JavaScript syntax, CSS structure, HTML preview rendering, and preservation of all WordPress hooks/handles.
- **No PHP execution, plugin runtime behaviour, or live RFQ mail delivery was executed here.**

Before staging or Hostinger deployment, validate on isolated WordPress (PHP 8.3):
- [ ] Run `php -l` on all PHP templates in `wp-content/themes/mazimpex/`.
- [ ] Verify Homepage, a commercial pillar page, a manufacturing page, and Request a Quote in Elementor Free editor (edit heading, save, reload, test Full Width & Canvas templates).
- [ ] Verify WooCommerce root division archives, child category archives, empty categories, and pagination (confirm 4-column desktop grid, no prices/cart/sorting, breadcrumbs once per page with Rank Math active).
- [ ] Verify complete and sparse Single Product pages across equipment and apparel divisions (FlexSlider + PhotoSwipe lightbox, focusable `.spec-scroll.maz-product-specs`, expandable `details.size-guide`, Quote/Sample/WhatsApp actions, related products).
- [ ] Verify general RFQ, product RFQ (`product_id`), sample request (`intent=sample`), file attachment (PDF/JPEG/PNG up to 2 MB), WhatsApp context, and mail sink delivery.
- [ ] Capture and review rendered screenshots at **1440px**, **820px**, and **390px** (desktop, tablet, mobile), checking keyboard focus, mobile submenu toggles, contrast on real hero photography, and `prefers-reduced-motion`.
