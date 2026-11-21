<footer class="site-footer"><div class="wrap">
<div><?php maz_theme_wordmark(); ?><p><?php echo esc_html( function_exists( 'maz_settings' ) ? maz_settings()['footer_line'] : 'Manufacturing enquiries' ); ?><br>Sialkot, Pakistan</p></div>
<nav aria-label="Manufacturing divisions">
<h2>Product divisions</h2>
<ul>
<?php foreach ( array(
	'combat-sports-equipment' => 'Combat sports equipment', 'combat-sportswear' => 'Combat sportswear',
	'team-sportswear' => 'Team sportswear', 'custom-clothing-activewear' => 'Custom clothing and activewear',
) as $slug => $label ) { ?>
<li><a href="<?php echo esc_url( home_url( '/product-category/' . $slug . '/' ) ); ?>"><?php echo esc_html( $label ); ?></a></li>
<?php } ?>
</ul>
</nav>
<?php
$programmes = array( 'boxing-gloves-manufacturer', 'custom-teamwear-manufacturer', 'private-label-clothing-manufacturer' );
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
<?php if ( function_exists( 'maz_settings' ) ) { ?>
<div><h2>Enquiries</h2><a href="mailto:<?php echo esc_attr( maz_settings()['email'] ); ?>"><i class="maz-icon fa-solid fa-envelope" aria-hidden="true"></i><?php echo esc_html( maz_settings()['email'] ); ?></a><br><a href="<?php echo esc_url( maz_whatsapp() ); ?>"><i class="maz-icon fa-brands fa-whatsapp" aria-hidden="true"></i>WhatsApp</a></div>
<?php } ?>
</div></footer>
<?php wp_footer(); ?>
</body></html>
