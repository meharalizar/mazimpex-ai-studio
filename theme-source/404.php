<?php get_header(); ?>
<main id="main" class="wrap entry maz-error-page">
<header class="page-header">
<p class="eyebrow">Error 404</p>
<h1>Page not found</h1>
<p class="lead">The page you requested could not be found. Return to the homepage, search the product catalogue above, or browse our four manufacturing divisions below.</p>
<div class="actions">
<a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>">Return to the homepage</a>
<a class="button secondary" href="<?php echo esc_url( home_url( '/request-a-quote/' ) ); ?>">Request a quote</a>
</div>
</header>
<section class="error-divisions" aria-label="Manufacturing divisions">
<h2>Browse manufacturing divisions</h2>
<div class="maz-category-grid maz-divisions-grid">
<?php foreach ( maz_theme_divisions() as $index => $division ) { ?>
<article class="card maz-catalogue-card">
<div class="maz-card-body">
<span class="maz-card-index">0<?php echo esc_html( (string) ( $index + 1 ) ); ?></span>
<h3><a href="<?php echo esc_url( $division['url'] ); ?>"><?php echo esc_html( $division['name'] ); ?></a></h3>
<p><?php echo esc_html( $division['summary'] ); ?></p>
<a class="maz-text-link" href="<?php echo esc_url( $division['url'] ); ?>">Explore division <span aria-hidden="true">&rarr;</span></a>
</div>
</article>
<?php } ?>
</div>
</section>
</main>
<?php get_footer(); ?>
