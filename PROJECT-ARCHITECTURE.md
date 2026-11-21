# Project architecture

The production candidate is `production-v1.0.0-rc.1`, commit `8d4531369fcf218d3955d26c992690e339f90568`. The private project targets Hostinger Business Web Hosting and PHP 8.3, subject to host validation. Site copy uses British English.

| Layer | Implementation | Design boundary |
| --- | --- | --- |
| WordPress | Page hierarchy, media IDs, navigation, search and custom logo | Keep template tags, hooks and existing stored settings |
| MAZ IMPEX theme | PHP shell, central CSS, menu and decorative canvas scripts | Update presentation in the existing files |
| Elementor Free 4.4.1 | 35 native layouts, including 19 commercial pillar pages | Reuse compatible containers, widgets and CSS classes |
| WooCommerce 11.3.0 | 161 seeded categories, 55 demonstration products and default template pipeline | Preserve hooks, IDs, URLs, galleries and catalogue restrictions |
| MAZ IMPEX Core | Marketing layout wiring, 13 size-guide families, catalogue, SEO fallback and RFQ frontend | Consume existing outputs |
| MAZ Request for Quote | Adapted private enquiry integration | Preserve the existing notification and record flow |
| Rank Math SEO Free 1.0.282 | Titles, descriptions, canonicals, breadcrumbs and sitemap when active | Preserve existing SEO state and output hooks |
| WP Mail SMTP 4.10.4 | Configurable delivery transport | Preserve the form contract and leave transport configuration to authorised admins |
| LiteSpeed Cache 7.9.3 | Optional Hostinger-dependent cache package | Keep contact and quote routes exempt from page caching |

Theme source mapping, packaging and validation are documented separately. [WordPress integration](WORDPRESS-INTEGRATION.md)
