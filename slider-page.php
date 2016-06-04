<?php
/**
 * The template for displaying pages with a hero slider
 * Template Name: Hero Slider
*/

get_header(); ?>

	<div id="primary" class="content-area">
		   <main id="main" class="site-main" role="main">

<?php ///

if ( have_rows( 'slides' ) ) {
	$use_srcset = false;
	if ( function_exists( 'wp_get_attachment_image_srcset' ) ) { $use_srcset = true; }

	/// ?>

	<div id="slider" class="flexslider slider-save-space">
		<ul class="slides">
			<?php
			$carousel = ''; // in case there's a carousel
			while ( have_rows( 'slides' ) ) { the_row();
				$image = get_sub_field( 'slide_image' );
				$slide_title = get_sub_field( 'slide_title' );
				$slide_caption = get_sub_field( 'slide_caption' );
				$slide_target = get_sub_field( 'slide_target' );
				if ( $slide_target ) {
					$href = '<a href="' . $slide_target . '">';
				}
				if ( $use_srcset ) {
					$src_set = ' srcset ="' . wp_get_attachment_image_srcset( $image['id'] ) . '" ';
				} else {
					$src_set = '';
				}
?>
		 <li><?php if ( $slide_target ) { echo $href; } ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" <?php echo $src_set; ?> /><?php if ( $slide_target ) { echo '</a>'; } ?>
				<?php if ( get_field( 'show_image_captions' ) ) { ?>
					<div class="flex-caption">
				<?php if ( $slide_title ) { ?> <span class="caption_title"><?php echo $slide_title; }?>
				<?php if ( $slide_caption ) { ?></span><?php echo $slide_caption; } ?></div>
				<?php } // captions ?>
					</li>
				<?php
				/* if a carousel is set, build  the carousel here and display later */
				if ( get_field( 'slider_carousel' ) ) {
					$carousel .= '<li><img src="' . $image['url'] . '" ' . $src_set . "/></li>\n";
				}
				?>
				<?php } // while have rows ?>
			</ul>
		</div>
		<?php if ( get_field( 'slider_carousel' ) ) { ?>
			<div id="carousel" class="flexslider">
				<ul class="slides">
					<?php echo $carousel; ?>
	      </ul>
			</div>

		<?php	} // carousel
} // images
	?>


	</div>


		<?php
		// Start the loop.
		while ( have_posts() ) {
			 the_post();

			// Include the page content template.
			get_template_part( 'content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			// End the loop.
		}  // while have_posts		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
