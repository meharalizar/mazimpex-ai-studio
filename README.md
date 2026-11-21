# MAZ IMPEX WordPress design handoff

MAZ IMPEX is an OEM/ODM and private-label manufacturer in Sialkot, Pakistan serving international B2B customers. Its divisions cover Combat Sports Equipment, Combat Sportswear, Team Sportswear, and Custom Clothing and Activewear.

The catalogue helps sports brands, wholesale importers, distributors, retailers, martial arts clubs, boxing gyms, fitness businesses, sports teams and private-label apparel buyers evaluate manufacturing capabilities, product specifications, customisation options and sample requirements. The site builds buyer confidence, supports commercial search visibility and routes qualified enquiries to the manufacturing team.

## Start here

1. Read the primary instructions before asking AI Studio to make changes. [AI Studio instructions](AI-STUDIO-INSTRUCTIONS.md)
2. Inspect the WordPress PHP templates, central stylesheet and vanilla JavaScript. [Theme source](theme-source/)
3. Read the design brief and inspect the page structure at each review width. [Design reference](DESIGN-REFERENCE.md) · [Page structure walkthroughs](reference-previews/README.md)
4. Upload the owner's visual reference image separately in AI Studio. Keep any licensed or unpublished assets in the owner's authorised review channel.
5. Export the proposed theme source and a change summary for Codex to integrate on a dedicated private branch. [Codex handoff](CODEX-HANDOFF.md)

## Project guides

| Guide | Scope |
| --- | --- |
| [Project architecture](PROJECT-ARCHITECTURE.md) | WordPress, theme, Elementor, WooCommerce and plugin responsibilities |
| [WordPress integration](WORDPRESS-INTEGRATION.md) | Source mapping, template hierarchy, staging and packaging |
| [Theme design system](THEME-DESIGN-SYSTEM.md) | Current tokens, proposed direction and component requirements |
| [Page templates](PAGE-TEMPLATES.md) | Homepage, catalogue, product and commercial pages |
| [WooCommerce templates](WOOCOMMERCE-TEMPLATES.md) | Standard templates, theme wrappers and catalogue hooks |
| [Elementor integration](ELEMENTOR-INTEGRATION.md) | Native layouts, classes and editor compatibility |
| [Quotation integration](RFQ-INTEGRATION.md) | Shortcodes, request context and presentation contracts |
| [SEO architecture](SEO-ARCHITECTURE.md) | Metadata, breadcrumbs, indexing and commercial topics |
| [Product category structure](PRODUCT-CATEGORY-STRUCTURE.md) | Public taxonomy names, hierarchy and illustrative product data |
| [Export review](docs/EXPORT-REVIEW.md) | Source provenance, exclusions and publication checks |

The website runs on WordPress with Elementor Free for marketing page editing and WooCommerce for the B2B catalogue. Rank Math governs SEO output. WP Mail SMTP handles mail transport when configured. MAZ IMPEX Core provides catalogue extensions and enquiry orchestration, with the adapted MAZ Request for Quote plugin integrated into the private enquiry workflow. The design deliverable is a PHP, CSS and vanilla JavaScript theme update for the existing WordPress installation.

## Import into Google AI Studio

In Google AI Studio, open **Build** and select **Add files (+)** → **Import from GitHub**. Select the `meharalizar/mazimpex-ai-studio` repository and its `main` branch after publication. Follow any GitHub connection prompt the interface presents. Paste the opening directive from the instruction file into the first message and ask AI Studio to read that file before editing. Attach the reference image separately. Use the **Code** view to review the resulting WordPress source. Confirm the owner has access to the repository before attempting the import. [Google AI Studio Build documentation](https://ai.google.dev/gemini-api/docs/aistudio-build-mode)

AI Studio's web Build preview uses a Node.js environment. Validate PHP and plugin behaviour in an isolated WordPress instance during Codex integration.
