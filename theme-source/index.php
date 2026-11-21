<?php get_header(); ?>
<main id="main" class="wrap entry">
<?php if ( ! is_singular() ) { ?><h1><?php echo esc_html( is_search() ? 'Search results' : ( is_home() ? 'Insights' : get_the_archive_title() ) ); ?></h1><?php } ?>
<?php while ( have_posts() ) { the_post(); ?>
<article><?php if ( is_singular() ) { the_title( '<h1>', '</h1>' ); the_content(); } else { ?><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_excerpt(); } ?></article>
<?php } ?>
<?php if ( ! have_posts() && ! did_action( 'loop_start' ) ) { ?><p>There are no results to display.</p><?php } ?>
<?php the_posts_pagination(); ?>
</main>
<?php get_footer(); ?>
