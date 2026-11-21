# WooCommerce templates

The private release uses WooCommerce's normal archive, loop and single-product templates. The theme declares WooCommerce, gallery slider and lightbox support, replaces the main-content wrappers with `<main id="main" class="wrap entry">` and removes the shop sidebar. Its closing hook calls `maz_category_details()` when Core supplies it. Preserve the opening and closing hooks, WooCommerce's loop hooks and the standard single-product hooks. [Theme bootstrap](theme-source/functions.php)

## Category archive

Keep the breadcrumb trail, archive title, category image and buyer-oriented description, child category links, product thumbnails and titles, pagination, category FAQ, related categories and quotation route. Core supplies the archive introduction on `woocommerce_archive_description` at priority 5 and child links on `woocommerce_before_shop_loop`. Category details follow the grid inside the main wrapper. Keep useful navigation on empty categories and retain their existing indexing decisions.

## Single product

Use the native WooCommerce image gallery, then the product name, SKU and visible attributes. Core replaces the normal excerpt with its specification table on `woocommerce_single_product_summary` at priority 22. It can include the short description as an overview. The table uses `.spec-scroll.maz-product-specs`, scoped header cells and a focusable scrolling region. Preserve the gallery, table, `details.size-guide`, material and branding information, product description, enquiry actions in `.summary .actions` and related products. Size guides resolve through the existing product and category assignments. Keep data-driven handling for legacy products with absent attributes, empty galleries or no size guide.

Preserve the catalogue policy and its purchasability filters, including variations. Keep price, stock and shopping actions out of the redesigned storefront. Test complete and sparse records, both example divisions and the mobile gallery and table. [Page templates](PAGE-TEMPLATES.md) · [RFQ integration](RFQ-INTEGRATION.md)
