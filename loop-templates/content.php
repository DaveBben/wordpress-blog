<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>




<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

	
<?php
	if ( has_post_thumbnail() ) : 
    ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php 
      echo get_the_post_thumbnail( $post->ID, 'large' ); 
    ?></a><?php 
endif; ?>

		<?php
		the_title(
			sprintf( '<h2 class="entry-title home"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h2>'
		);
		?>

		<?php if ( 'post' == get_post_type() ) : ?>

			<div class="entry-meta">
				<?php understrap_posted_on(); ?>
			</div><!-- .entry-meta -->

		<?php endif; ?>

	</header><!-- .entry-header -->



	<div class="entry-content">

		<?php the_excerpt(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->


</article><!-- #post-## -->
