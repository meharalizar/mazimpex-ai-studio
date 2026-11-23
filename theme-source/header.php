<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header" id="site-header">
<div class="wrap header-inner">
<?php if ( has_custom_logo() ) { the_custom_logo(); } else { ?>
<?php maz_theme_wordmark(); ?>
<?php } ?>
<button class="nav-toggle" type="button" aria-controls="primary-navigation" aria-expanded="false">
<span class="nav-toggle-bars" aria-hidden="true"></span>
<span>Menu</span>
</button>
<nav class="site-nav" id="primary-navigation" aria-label="Primary"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'div', 'fallback_cb' => false ) ); ?></nav>
<form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
<label class="screen-reader-text" for="catalogue-search">Search products</label>
<input id="catalogue-search" type="search" name="s" placeholder="Search products" value="<?php echo esc_attr( get_search_query( false ) ); ?>">
<input type="hidden" name="post_type" value="product">
<button class="search-submit" type="submit" aria-label="Search products"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i></button>
</form>
<a class="button" href="<?php echo esc_url( home_url( '/request-a-quote/' ) ); ?>">Request a quote</a>
<?php if ( function_exists( 'maz_whatsapp' ) ) { ?><a class="header-whatsapp" href="<?php echo esc_url( maz_whatsapp() ); ?>"><i class="maz-icon fa-brands fa-whatsapp" aria-hidden="true"></i><span>WhatsApp</span></a><?php } ?>
</div>
</header>
