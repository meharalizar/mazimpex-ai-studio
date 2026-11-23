<footer class="site-footer">
<div class="wrap footer-grid">
<div class="footer-brand">
<?php maz_theme_wordmark(); ?>
<p class="footer-summary"><?php echo esc_html( function_exists( 'maz_settings' ) ? maz_settings()['footer_line'] : 'OEM, ODM and private-label manufacturing enquiries' ); ?></p>
<p class="footer-origin">Sialkot, Pakistan</p>
</div>
<nav aria-label="Manufacturing divisions">
<h2>Product divisions</h2>
<ul>
<?php foreach ( maz_theme_divisions() as $division ) { ?>
<li><a href="<?php echo esc_url( $division['url'] ); ?>"><?php echo esc_html( $division['name'] ); ?></a></li>
<?php } ?>
</ul>
</nav>
<?php
$programmes      = array( 'boxing-gloves-manufacturer', 'custom-teamwear-manufacturer', 'private-label-clothing-manufacturer' );
$programme_links = array();
foreach ( $programmes as $slug ) {
	$programme = get_page_by_path( $slug );
	if ( $programme && 'publish' === $programme->post_status ) {
		$programme_links[] = $programme;
	}
}
if ( $programme_links ) {
	?>
<nav aria-label="Manufacturing programmes">
<h2>Manufacturing programmes</h2>
<ul>
<?php foreach ( $programme_links as $programme ) { ?>
<li><a href="<?php echo esc_url( get_permalink( $programme ) ); ?>"><?php echo esc_html( get_the_title( $programme ) ); ?></a></li>
<?php } ?>
</ul>
</nav>
<?php } ?>
<?php if ( has_nav_menu( 'footer' ) ) { wp_nav_menu( array( 'theme_location' => 'footer', 'container' => 'nav', 'container_aria_label' => 'Footer' ) ); } ?>
<div class="footer-enquiries">
<h2>Enquiries</h2>
<ul>
<?php if ( function_exists( 'maz_settings' ) ) { ?>
<li><a href="mailto:<?php echo esc_attr( maz_settings()['email'] ); ?>"><i class="maz-icon fa-solid fa-envelope" aria-hidden="true"></i><?php echo esc_html( maz_settings()['email'] ); ?></a></li>
<li><a href="<?php echo esc_url( maz_whatsapp() ); ?>"><i class="maz-icon fa-brands fa-whatsapp" aria-hidden="true"></i>WhatsApp</a></li>
<?php } ?>
<li><a href="<?php echo esc_url( home_url( '/request-a-quote/' ) ); ?>"><i class="maz-icon fa-solid fa-file-signature" aria-hidden="true"></i>Request a quote</a></li>
</ul>
</div>
</div>
<div class="site-footer-bottom">
<div class="wrap footer-bottom-inner">
<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> MAZ IMPEX. All rights reserved.</p>
<p>OEM / ODM &amp; Private-Label Manufacturing &middot; Sialkot, Pakistan</p>
</div>
</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
