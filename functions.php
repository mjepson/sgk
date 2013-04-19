<?php

/*----------------------------------------------------------------*/
/*
	GENERAL SETUP
*/
/*----------------------------------------------------------------*/

// Disable stuff from Canvas
add_action( 'init', 'remove_canvas_bloat' );
function remove_canvas_bloat() {

	// Remove feedback JS
	add_filter( 'woo_load_feedback_js', '__return_false' );
	
	// Remove site width
	remove_action( 'wp_head', 'woo_load_site_width_css', 10 );
	
	// Remove custom styles
	remove_action( 'wp_head', 'woo_enqueue_custom_styling' );
	
	// Remove Meta tags
	if ( get_option( 'framework_woo_disable_generator' ) == 'false' ) update_option( 'framework_woo_disable_generator', 'true' );
	
	// RSS icon in nav
	remove_action( 'woo_nav_inside','woo_nav_subscribe' );	

    // Remove main nav from the woo_header_after hook
    remove_action( 'woo_header_after','woo_nav', 10 );

    // Add main nav to the woo_header_inside hook
    add_action( 'woo_header_inside','woo_nav', 10 );
       
}

// Setup logo
add_action( 'wp_head', 'woo_custom_logo' );
function woo_custom_logo () {
	global $woo_options;
	$woo_options[ 'woo_logo' ] = get_stylesheet_directory_uri() . '/images/logo.png';
} 

// Add google fonts
function woo_custom_font()  {  
    wp_register_style( 'google-font', 'http://fonts.googleapis.com/css?family=Coda|Arvo:400,700' );  
    wp_enqueue_style( 'google-font' );  
}  
add_action( 'wp_enqueue_scripts', 'woo_custom_font' );  

// Footer Copyright
function woo_shortcode_site_copyright ( $atts ) {	
	$output = "<p>&copy; " . date( 'Y' ) . " " . get_bloginfo( 'name' ) . "</p>";
	return apply_filters( 'woo_shortcode_site_copyright', $output, $atts );
} // End woo_shortcode_site_copyright()

function woo_shortcode_site_credit ( $atts ) {	
	$output = '<p><a href="' . get_admin_url() . '">Logg Inn</a> - Design av Magnus Jepson</p>';
	return do_shortcode( apply_filters( 'woo_shortcode_site_credit', $output, $atts ) );
} // End woo_shortcode_site_credit()


// Add address in header
add_action( 'woo_header_inside','header_address', 10);
function header_address() {
	echo '<div class="address">';
	echo '<span><i class="icon-home"></i>Longebakke 45, 4042 Hafrsfjord</span>';
	echo '<span><i class="icon-iphone"></i>+47 51 93 91 00</span>';
	echo '<span><i class="icon-pin"></i><a href="http://goo.gl/maps/uA84n">Vis på kart</a></span>';
	echo '<span><i class="icon-facebook"></i><a href="http://www.facebook.com/pages/Stavanger-Golfklubb/207282459299305">Facebook</a></span>';
	echo '<span><i class="icon-globe"></i><a href="http://www.sgk.no/english/">English</a></span>';
	echo '</div>';
}

// Add FBlike to Junior
add_action ( 'woo_post_inside_after', 'add_fb_like' );
function add_fb_like() {
	if ( is_single() ) {
		echo do_shortcode( '[fblike]' );
	}
}

// Disable output of site width in HEAD
function woo_load_site_width_css_nomedia() {}

/*----------------------------------------------------------------*/
/*
	SLIDER  SETUP
*/
/*----------------------------------------------------------------*/

// Display the "Business" slider above the default WordPress homepage.
add_action( 'get_header', 'woo_custom_load_biz_slider', 10 );
 
function woo_custom_load_biz_slider () {
    add_action( 'woo_load_slider_js', '__return_true', 10 );
    if ( is_front_page() OR is_page('english') ) {
		add_action( 'woo_header_after', 'header_container_start', 10 );
        add_action( 'woo_header_after', 'woo_slider_biz', 10 );
        add_action( 'woo_header_after', 'woo_custom_reset_biz_query', 11 );
		add_action( 'woo_header_after', 'header_container_end', 12 );
        add_filter( 'body_class', 'woo_custom_add_business_bodyclass', 10 );
        if ( get_option('woo_layout_width' ) != '1400' ) update_option('woo_layout_width', '1400');
    }
} // End woo_custom_load_biz_slider()
 
function woo_custom_add_business_bodyclass ( $classes ) {
    if ( is_front_page() OR is_page('english') ) {
        $classes[] = 'business';
    }
    return $classes;
} // End woo_custom_add_biz_bodyclass()
 
function woo_custom_reset_biz_query () {
    wp_reset_query();
} // End woo_custom_reset_biz_query()

// Add header container
function header_container_start() { ?>
	<!--#slider-container-->
	<div id="slider-container">
<?php
}
function header_container_end() { ?>
	</div><!--/#slider-container-->
<?php
}


/*----------------------------------------------------------------*/
/*
	SPONSOR SLIDER
*/
/*----------------------------------------------------------------*/


// Add sponsor to footer
add_action( 'wp_head','add_sponsor_slider', 10);
function add_sponsor_slider() {
	if ( ! is_page( 87 ) )
		add_action( 'woo_footer_top','footer_sponsors', 10);
}
	
function footer_sponsors() {

	// Shuffle sponsors
	$numbers = range(1,get_option('wp125_num_slots')); 
	shuffle($numbers);
	$counter = 0;

?>
    <div id="sponsor" class="col-full">
    	<div id="hoved">
    		<a href="https://www.skagenfondene.no/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/sponsor/sponsor-skagen.png" alt="Skagenfondene" /></a>
    		<span>Hovedsamarbeidspartner</span>
    	</div>
    	<div id="sponsor-slider">
    		<ul class="slides">
    		
		<?php
			foreach ($numbers as $number) {	
				$counter++;
			
		?>
	    		<li class="sponsor"><?php wp125_single_ad($number); ?></li>

		<?php } ?>
    		
	    	</ul>
    	</div>
    </div>
    <div class="fix"></div>
        
<script type="text/javascript">
jQuery(window).load(function() {
	jQuery('#sponsor-slider').flexslider({
    animation: "slide",
    animationLoop: true,
    itemWidth: 210,
    itemMargin: 0,
	minItems: 1,
    maxItems: 3,
	slideshowSpeed: 4000, 
	animationSpeed: 300,
	controlNav: false      
    });
});
</script>
<?php
}

?>