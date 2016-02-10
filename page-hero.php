<?php
/**
 * The template for displaying pages with a hero slider
 * Template Name: Hero Slider
*/

get_header(); ?>

	<div id="primary" class="content-area">
           <main id="main" class="site-main" role="main">

<?php ///

$images = get_field('hero_slider');
if ( $images ) {
$use_srcset = false;
if ( function_exists( 'wp_get_attachment_image_srcset' ) ) $use_srcset=true;

/// ?>

    <div id="slider" class="flexslider">
        <ul class="slides">
            <?php foreach( $images as $image ) { 
              if ( $use_srcset ) {
                 $src_set = ' srcset ="' . wp_get_attachment_image_srcset( $image['id'] ) . '" ';
                 }
               else {
                $src_set = '';
                }
?>
         <li> <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" <?php echo $src_set; ?> />
             <?php if ( get_field ( 'show_image_captions' ) ) { ?>
              <p class="flex-caption"><?php echo $image['caption']; ?></p>
              <?php } // captions ?>
         </li>
			  <?php } // foreach ?>
			</ul>
		</div>
     <?php if ( get_field( 'slider_carousel') ) { ?>

			<div id="carousel" class="flexslider">
	        <ul class="slides">
	            <?php foreach( $images as $image ) { ?>
	            <li>
                <img src="<?php echo $image['url']; ?>" />
	            </li>

	 <?php } // foreach ?>
	         </ul>

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
