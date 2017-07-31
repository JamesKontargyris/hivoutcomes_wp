<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package hivoutcomes
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<div class="news-extract">
			<?php if(has_post_thumbnail()) : ?>
				<a href="<?php echo get_the_permalink(); ?>" class="news-extract__image-link">
					<img class="news-extract__image" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'news-extract'); ?>" alt="<?php the_title(); ?>">
				</a>
			<?php endif; ?>
			<div class="news-extract__details">
                <div class="news-extract__meta"><?php the_date(); ?></div>
				<h2 class="news-extract__title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p class="news-extract__extract">
					<?php echo get_field('extract'); ?> <a href="<?php echo get_the_permalink(); ?>">Read more...</a>
				</p>
			</div>
		</div>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
