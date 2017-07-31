<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package hivoutcomes
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post(); ?>

                <div class="news">

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		                <?php if(has_post_thumbnail()) : ?>
                            <img class="news__banner" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'news-banner'); ?>" alt="<?php the_title(); ?>">
		                <?php endif; ?>

                        <h3><?php the_date(); ?></h3>
                        <h1><?php the_title(); ?></h1>

                        <hr>

                        <div class="entry-content">
			                <?php
			                the_content();
			                ?>
                        </div><!-- .entry-content -->

                    </article><!-- #post-## -->

                </div>


			<?php endwhile; // End of the loop.
			?>

            <p><a href="/news"><strong>&lt; More news</strong></a></p>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
