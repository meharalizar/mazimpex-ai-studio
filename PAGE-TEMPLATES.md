# Page templates

| Page | Actual renderer and section ownership |
| --- | --- |
| Header and footer | `header.php` and `footer.php` render the WordPress navigation, logo, search, quote action, enquiry links and footer divisions |
| Homepage | `page.php` and the current Elementor data render the editable hero, links to divisions and categories, manufacturing information and enquiry CTA. The theme owns the photographic hero slots |
| Product divisions | Root WooCommerce category archives use the normal catalogue templates with Core taxonomy sections |
| Category archives and products | WooCommerce default templates, theme wrappers and Core hooks provide the archive and product regions |
| Manufacturing, OEM/ODM and About | WordPress Pages with Elementor layouts where assigned. Maintain the capability, materials, customisation and enquiry links |
| Contact and Request a Quote | WordPress Pages keep existing layout and Core shortcodes |
| Commercial pillars | Elementor marketing layouts tied to existing WordPress pages and SEO settings |
| Search and errors | `index.php` and `404.php` keep the catalogue discovery routes and navigation shell |

For the proposed homepage composition, retain header, hero and footer, then arrange the manufacturing capability strip, four divisions, category discovery, featured products, OEM/ODM process, custom branding, materials, quality control, international manufacturing services and quotation CTA. Use existing approved copy and content fields when populating those regions. Let editable Elementor content remain the single source for its sections.

For category and product structure, keep the order and hooks described in the catalogue guide. [WooCommerce templates](WOOCOMMERCE-TEMPLATES.md) · [Page structure walkthroughs](reference-previews/README.md)
