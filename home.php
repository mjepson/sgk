<?php
/**
 * Index Template
 *
 * The index template is a placeholder for all cases that don't have a template file. 
 * Ideally, all fases would be handled by a more appropriate template according to the
 * current page context (for example, `tag.php` for a `post_tag` archive or `single.php`
 * for a single blog post).
 *
 * @package WooFramework
 * @subpackage Template
 */

 get_header();
 global $woo_options;
?>      
    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div id="content" class="col-full">
    
    	<div id="main-sidebar-container">    
		
            <!-- #main Starts -->
            <?php woo_main_before(); ?>
            
           		<div class="news col-1">
           			<h3><i class="icon-newspaper"></i>Siste Nyheter</h3>
					<?php get_template_part( 'loop', 'home' ); ?>
					<a href="<?php echo home_url(); ?>/nyheter/" class="archive-link">Les eldre nyheter i arkivet &rarr;</a>
           		</div>
           		
           		<div class="col-2">
           		
	           		<div class="banestatus">
	           			<?php query_posts('page_id=4012'); the_post(); global $more; $more = 0; ?>
	           			<h3><i class="icon-question"></i><?php the_title(); ?></h3>
						<?php the_content('Les Mer &rarr;'); ?>	
						<?php edit_post_link(); ?>             		
 					</div>
	           		
	           		<div class="instruksjon">
	           			<?php query_posts('page_id=5025'); the_post(); global $more; $more = 0; ?>
	           			<h3><i class="icon-users"></i><?php the_title(); ?></h3>
						<?php the_content('Les Mer &rarr;'); ?>	
						<?php edit_post_link(); ?>             		
	           		</div>
           		
           		</div>
           		
           		<div class="golfbox col-3">
           			<script src="http://external.norskgolf.no/golfbox/golfbox_login_green.js" type="text/javascript"></script>
           			<noscript><a href="http://www.golfbox.no/portal/login/help.asp" target="_blank">Golfbox Login</a></noscript>
           		</div> 
    
		</div><!-- /#main-sidebar-container -->         

    </div><!-- /#content -->
        
	<?php woo_content_after(); ?>
		
<?php get_footer(); ?>