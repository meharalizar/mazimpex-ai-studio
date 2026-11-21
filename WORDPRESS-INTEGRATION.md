# WordPress integration

Copy approved source changes from `theme-source/` into `wp-content/themes/mazimpex/` on a private redesign branch. Review individual diffs so the existing production media, approved logos and vendor dependencies survive the integration. Start from the release candidate or a later verified private baseline.

The actual theme consists of `header.php`, `footer.php`, `page.php`, `index.php`, `404.php`, `functions.php`, the central `style.css`, `navigation.js` and `particles.js`. `page.php` renders the homepage and normal WordPress Pages through the Loop and `the_content()`. WooCommerce uses its own plugin templates plus the theme and Core hooks. Keep that hierarchy unless an approved enhancement requires a specific template override. Retain `wp_head()`, `wp_body_open()`, `wp_footer()`, `body_class()`, language attributes and the `#main` skip-link destination.

Preserve all enqueue handles, asset versioning and WordPress escaping practices. The theme uses Font Awesome 6.7.2 via the existing CDN outside `local` and the site's bundled copy in `local`. The handoff contains placeholders for required theme assets. Use the private original files in actual WordPress tests.

Package an installable theme ZIP in the private project with `mazimpex/` as its root and its WordPress theme header in `style.css`. Keep plugins and content migrations in their existing private release packaging. Validate on the isolated WordPress stack with the release plugin versions. Keep settings, orders, users and enquiries from the destination site during any scoped staging migration. [Codex handoff](CODEX-HANDOFF.md)
