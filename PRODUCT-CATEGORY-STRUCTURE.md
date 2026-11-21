# Product category structure

WooCommerce uses hierarchical `product_cat` terms. The catalogue seed contains 161 categories under Combat Sports Equipment, Combat Sportswear, Team Sportswear, and Custom Clothing and Activewear. Term IDs, slugs and parent relationships belong to the existing WordPress installation. Resolve links through WordPress in production because the permalink configuration controls the final URLs.

[Category tree](sample-data/category-tree.json) contains the released taxonomy's names, slugs and parent slugs. A null parent identifies a root. [Display-only product examples](sample-data/product-examples.json) illustrate the shape of a specification table, gallery and sizing slot. Treat the examples as design references without product imports, prices or stock claims.

Existing product attributes, demonstration records, SEO metadata, size guides and term images remain in the private project. [WooCommerce templates](WOOCOMMERCE-TEMPLATES.md)
