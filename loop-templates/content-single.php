<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">

			<?php understrap_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php $yt = get_post_meta(get_the_ID(), 'my_meta_box_text', true);
				if (isset($yt) && $yt !== '') { ?>
					<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="" width="300" height="150" allowfullscreen="allowfullscreen" data-src="//www.youtube.com/embed/<?php echo $yt ?> "></iframe></div>
					<?php 
				}
				else{
					 echo get_the_post_thumbnail( $post->ID, 'large' ); 
					
				}
			?>
<hr>
	<!-- Responsive Link Ads -->
		<ins class="adsbygoogle"
		style="display:block"
		data-ad-client="ca-pub-6594501022141871"
		data-ad-slot="6223025728"
		data-ad-format="link"></ins>
	<hr>


	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
