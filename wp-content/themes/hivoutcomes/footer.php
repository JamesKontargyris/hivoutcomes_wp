<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hivoutcomes
 */

?>
    <?php dynamic_sidebar('content-area-footer'); ?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php wp_nav_menu( array( 'theme_location' => 'menu-footer', 'menu_id' => 'footer-menu', 'depth' => '1' ) ); ?>
			<?php dynamic_sidebar('site-footer'); ?>
        </div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
