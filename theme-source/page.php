<?php get_header(); ?>
<?php while ( have_posts() ) { the_post(); ?>
<?php $layout = function_exists( 'maz_has_marketing_layout' ) && maz_has_marketing_layout( get_the_ID() ); ?>
<main id="main" class="<?php echo $layout ? 'maz-elementor-content' : ( is_front_page() ? 'homepage' : 'wrap entry' ); ?>">
<?php if ( $layout && ! class_exists( '\Elementor\Plugin' ) && 'local' === wp_get_environment_type() ) { ?>
<div class="maz-review-layout">
<?php echo maz_render_elementor_review( json_decode( get_post_meta( get_the_ID(), '_elementor_data', true ), true ) ?: array() ); ?>
</div>
<?php } else { ?>
<?php if ( ! $layout && ! is_front_page() ) { the_title( '<h1>', '</h1>' ); } ?>
<?php if ( ! $layout && ! is_front_page() && has_post_thumbnail() ) { ?>
<figure class="page-feature"><?php the_post_thumbnail( 'large' ); ?><figcaption>Illustrative manufacturing image</figcaption></figure>
<?php } ?>
<?php the_content(); ?>
<?php } ?>
</main>
<?php } ?>
<?php get_footer(); ?>
