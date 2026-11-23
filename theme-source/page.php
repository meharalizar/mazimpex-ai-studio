<?php get_header(); ?>
<?php while ( have_posts() ) { the_post(); ?>
<?php $layout = function_exists( 'maz_has_marketing_layout' ) && maz_has_marketing_layout( get_the_ID() ); ?>
<main id="main" class="<?php echo $layout ? 'maz-elementor-content' : ( is_front_page() ? 'homepage' : 'wrap entry' ); ?>">
<?php if ( $layout && ! class_exists( '\Elementor\Plugin' ) && 'local' === wp_get_environment_type() ) { ?>
<div class="maz-review-layout">
<?php echo maz_render_elementor_review( json_decode( get_post_meta( get_the_ID(), '_elementor_data', true ), true ) ?: array() ); ?>
</div>
<?php } elseif ( ! $layout && is_front_page() && '' === trim( (string) get_the_content() ) ) { ?>
<section class="hero maz-hero">
<div class="wrap maz-hero-inner">
<p class="eyebrow">OEM / ODM &amp; Private-Label Manufacturing &middot; Sialkot, Pakistan</p>
<h1>Industrial manufacturing for combat sports, teamwear and custom apparel</h1>
<p class="lead">Built for international sports brands, wholesale importers, academies and clubs requiring custom specifications, private-label branding and structured sampling.</p>
<div class="maz-hero-actions">
<a class="button" href="<?php echo esc_url( home_url( '/request-a-quote/' ) ); ?>">Request a quote</a>
<a class="button secondary" href="#manufacturing-divisions">Explore divisions</a>
</div>
</div>
</section>
<section class="section dark maz-capability-strip" aria-label="Manufacturing capabilities">
<div class="wrap">
<div class="maz-section-head">
<p class="eyebrow">Manufacturing capability</p>
<h2>Direct production across equipment and technical apparel</h2>
</div>
<div class="maz-capability-grid">
<article class="maz-info-card">
<span class="maz-step-num" aria-hidden="true">01</span>
<h3>OEM &amp; ODM Development</h3>
<p>Pattern grading, technical specification alignment and custom construction tailored to your brand requirements.</p>
</article>
<article class="maz-info-card">
<span class="maz-step-num" aria-hidden="true">02</span>
<h3>Private-Label Branding</h3>
<p>Embroidery, screen printing, sublimation, heat transfer, woven labels and custom packaging options.</p>
</article>
<article class="maz-info-card">
<span class="maz-step-num" aria-hidden="true">03</span>
<h3>Structured Sampling</h3>
<p>Pre-production samples for fit, material evaluation and artwork sign-off before bulk manufacturing.</p>
</article>
<article class="maz-info-card">
<span class="maz-step-num" aria-hidden="true">04</span>
<h3>Export-Ready Fulfilment</h3>
<p>Direct factory communication from Sialkot for international brands, clubs, distributors and wholesalers.</p>
</article>
</div>
</div>
</section>
<section class="section" id="manufacturing-divisions">
<div class="wrap">
<div class="maz-section-head">
<p class="eyebrow">Product divisions</p>
<h2>Four specialist manufacturing divisions</h2>
<p class="maz-section-intro">Browse our B2B catalogue by manufacturing line to review product specifications, sizing references and customisation pathways.</p>
</div>
<div class="maz-category-grid maz-divisions-grid">
<?php foreach ( maz_theme_divisions() as $index => $division ) { ?>
<article class="card maz-catalogue-card">
<div class="maz-card-body">
<span class="maz-card-index">0<?php echo esc_html( (string) ( $index + 1 ) ); ?></span>
<h3><a href="<?php echo esc_url( $division['url'] ); ?>"><?php echo esc_html( $division['name'] ); ?></a></h3>
<p><?php echo esc_html( $division['summary'] ); ?></p>
<a class="maz-text-link" href="<?php echo esc_url( $division['url'] ); ?>">View division <span aria-hidden="true">&rarr;</span></a>
</div>
</article>
<?php } ?>
</div>
</div>
</section>
<section class="section maz-conversion">
<div class="wrap maz-conversion-inner">
<p class="eyebrow">Commercial enquiries</p>
<h2>Start a quotation or sample request</h2>
<p class="lead">Share your product category, quantities, artwork requirements and target delivery schedule with our Sialkot manufacturing team.</p>
<div class="actions">
<a class="button" href="<?php echo esc_url( home_url( '/request-a-quote/' ) ); ?>">Request a quote</a>
<?php if ( function_exists( 'maz_whatsapp' ) ) { ?>
<a class="button secondary" href="<?php echo esc_url( maz_whatsapp() ); ?>"><i class="maz-icon fa-brands fa-whatsapp" aria-hidden="true"></i>WhatsApp</a>
<?php } ?>
</div>
</div>
</section>
<?php } else { ?>
<?php if ( ! $layout && ! is_front_page() ) { ?>
<header class="page-header">
<?php the_title( '<h1>', '</h1>' ); ?>
</header>
<?php } ?>
<?php if ( ! $layout && ! is_front_page() && has_post_thumbnail() ) { ?>
<figure class="page-feature"><?php the_post_thumbnail( 'large' ); ?><figcaption>Illustrative manufacturing image</figcaption></figure>
<?php } ?>
<?php the_content(); ?>
<?php } ?>
</main>
<?php } ?>
<?php get_footer(); ?>
