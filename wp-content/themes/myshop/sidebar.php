<?php
/**
 * The Content Sidebar
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
require get_template_directory() . '/core/init.php';
add_action( 'init', 'sidebar' );

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}

?>
<div id="content-sidebar" class="content-sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</div><!-- #content-sidebar -->
<?php
?>