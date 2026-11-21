# Quotation frontend contract

The existing Core shortcode `[maz_rfq]` renders the enquiry form. `[maz_contact]` renders configured business contact links. Keep those shortcodes in Elementor Shortcode widgets where already assigned.

| Flow | WordPress contract |
| --- | --- |
| General and OEM/ODM enquiries | Link to `/request-a-quote/` |
| Product enquiry | Use the existing quote helper with `product_id` context |
| Sample request | Use the same URL with `product_id` and `intent=sample` |
| Contact enquiries | Preserve the contact page origin and the existing shortcode setup |
| WhatsApp | Use the configured helper, retaining product title and SKU in the context where present |

The server-rendered form uses `.rfq-form.maz-rfq-form` and a multipart POST to `admin_url('admin-post.php')` with action `maz_submit_enquiry`. Keep all existing form fields, validation, hidden context, nonce, attachment behaviour and accessible status messages. The existing attachment prompt supports PDF, JPEG and PNG up to 2 MB. Maintain form styling and keep the quote and contact pages excluded from page caching. Preserve the normal redirects and error recovery.

The Core and adapted private quotation plugin already coordinate processing and notifications. Preserve the authorised default business mailbox `info@mazimpex.com`, validated Reply-To handling and private records. Test each flow against a mail sink on staging and confirm one intended notification and one private enquiry record per successful submission. Do not route preview controls to live endpoints. [WooCommerce templates](WOOCOMMERCE-TEMPLATES.md)
