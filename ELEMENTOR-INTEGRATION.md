# Elementor Free integration

The source release has 35 native Elementor layouts, including 19 commercial pillar pages. The editable sections and widgets live in WordPress page data. The private Core project defines the layout source in `inc/elementor-layouts.php`, import logic in `inc/elementor-cli.php` and rendering helpers in `inc/elementor.php`. The handoff includes the theme integration and describes the layout contracts.

Use native Free containers, heading, text, image, button and shortcode widgets. Keep existing WordPress page IDs, media IDs and document data. Maintain Elementor's normal `the_content()` render path. The existing pages use the default theme shell. Preserve compatibility with Full Width and Canvas, and verify the theme header and footer appear only where the selected page template expects them. The local fallback in `page.php` is a read-only preview when Elementor is absent.

Use reusable classes such as `.maz-elementor-content`, `.maz-hero` and `.maz-category-grid`. Centralise presentation in the theme stylesheet. Preserve existing responsive controls, heading semantics and the shortcode widget contents. Propose Elementor composition and class changes separately so Codex can apply them without overwriting edited documents. Use native nested containers and responsive visibility controls where a draft suggests a Pro-only feature.

On isolated WordPress, open the homepage, a manufacturing page, a commercial pillar and the RFQ page in the editor. Verify desktop, tablet and mobile rendering, edit and save a heading, reopen it, and reuse a section template. [Theme page wrapper](theme-source/page.php)
