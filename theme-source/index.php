<?php get_header(); ?>
<main id="main" class="wrap entry">
<?php if ( ! is_singular() ) { ?>
<header class="archive-header">
<p class="eyebrow"><?php echo esc_html( is_search() ? 'Catalogue search' : ( is_home() ? 'Manufacturing insights' : 'Archive' ) ); ?></p>
<h1><?php echo esc_html( is_search() ? 'Search results' : ( is_home() ? 'Insights' : wp_strip_all_tags( get_the_archive_title() ) ) ); ?></h1>
<?php if ( is_search() && '' !== get_search_query() ) { ?>
<p class="archive-subtitle">Showing results for &ldquo;<?php echo esc_html( get_search_query() ); ?>&rdquo;</p>
<?php } ?>
</header>
<?php } ?>
<?php if ( have_posts() ) { ?>
<?php if ( is_singular() ) { ?>
<?php while ( have_posts() ) { the_post(); ?>
<article class="single-entry">
<header class="page-header"><?php the_title( '<h1>', '</h1>' ); ?></header>
<?php if ( has_post_thumbnail() ) { ?>
<figure class="page-feature"><?php the_post_thumbnail( 'large' ); ?></figure>
<?php } ?>
<div class="entry-content"><?php the_content(); ?></div>
</article>
<?php } ?>
<?php } else { ?>
<div class="search-results-grid">
<?php while ( have_posts() ) { the_post(); ?>
<article class="card search-result-card">
<?php if ( has_post_thumbnail() ) { ?>
<a class="search-result-thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large' ); ?></a>
<?php } ?>
<div class="maz-card-body">
<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<div class="search-result-excerpt"><?php the_excerpt(); ?></div>
<a class="maz-text-link" href="<?php the_permalink(); ?>">View details <span aria-hidden="true">&rarr;</span></a>
</div>
</article>
<?php } ?>
</div>
<?php } ?>
<?php } elseif ( ! did_action( 'loop_start' ) ) { ?>
<div class="empty-state">
<p>There are no results to display for your query.</p>
<div class="actions">
<a class="button" href="<?php echo esc_url( home_url( '/request-a-quote/' ) ); ?>">Request a quote</a>
<a class="button secondary" href="<?php echo esc_url( home_url( '/' ) ); ?>">Return to homepage</a>
</div>
</div>
<?php } ?>
<?php the_posts_pagination(); ?>
</main>
<?php get_footer(); ?>
