<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen_child
 * @since Twenty Sixteen Child 1.0
 */

get_header(); ?>

<div id="primary">
	<div id="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<h1><?php the_field('name'); ?></h1>

			<img src="<?php the_field('hero_image'); ?>" width="300px" />
			<img src="<?php the_field('supporting_image_1'); ?>" width="300px" />
			<img src="<?php the_field('supporting_image_2'); ?>" width="300px" />

			<p><?php the_content(); ?></p>


		<?php endwhile; // end of the loop. ?>


	</div><!-- #content -->
</div><!-- #primary -->


<?php get_sidebar(); ?>
<?php get_footer(); ?>
