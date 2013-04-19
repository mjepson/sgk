<?php
/**
 * Template Name: Sponsor
 *
 * The business page template displays your posts with a "business"-style
 * content slider at the top. 
 *
 * @package WooFramework
 * @subpackage Template
 */

 global $woo_options, $wp_query; 
 get_header();
 
 $page_template = woo_get_page_template();
?>
    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div id="content" class="col-full business">
    
    	<div id="main-sidebar-container">

            <!-- #main Starts -->
            <?php woo_main_before(); ?>
            <div id="main">      
<?php
	woo_loop_before();
	
	if ( have_posts() ) { $count = 0;
		while ( have_posts() ) { the_post(); $count++;
			woo_get_template_part( 'content', 'page' ); // Get the page content template file, contextually.
		}
	}
	
	woo_loop_after();
?>        

<?php
	// Shuffle sponsors
	$numbers = range(1,get_option('wp125_num_slots')); 
	shuffle($numbers);
	$counter = 0;
?>
			<h3>Alle Samarbeidspartnere</h3>
			
			<ul class="sponsor-others">
				<?php
					foreach ($numbers as $number) {	
						$counter++;
				?>
			    		<li class="sponsor"><?php wp125_single_ad($number); ?></li>
				<?php } ?>

			</ul>

            </div><!-- /#main -->
            <?php woo_main_after(); ?>
    
			<?php get_sidebar(); ?>
            
		</div><!-- /#main-sidebar-container -->         

		<?php get_sidebar( 'alt' ); ?>

    </div><!-- /#content -->
	<?php woo_content_after(); ?>
    
<?php get_footer(); ?>