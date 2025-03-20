<?php

function memberdirectoryportal_post_page() {
	global $post;
	return str_contains( $post->post_type, "mdp_" );
}

add_action( 'wp_enqueue_scripts', 'memberdirectoryportal_enqueue_styles' );

function memberdirectoryportal_enqueue_styles() {

	global $post;

	global $apidata;
  $apidata = get_post_meta( $post->ID, 'mdp_data', true);
  $apidata = json_decode($apidata);

	# if content is related to plugin
	if( str_contains( $post->post_content, "[mdpsc" ) || memberdirectoryportal_post_page() ) {
		wp_enqueue_style( 
			'member-directoryportal-style', 
			MDP_PLUGIN_URI . "assets/style.css"
		);
	}

	# if single post
	if( memberdirectoryportal_post_page() ) {
		wp_enqueue_script('jquery');

		wp_enqueue_script( 
			'member-directoryportal-post', 
			MDP_PLUGIN_URI . "assets/scripts/post.js", 
			array(),
			'1.0',
			true 
		);
	}

	# if post contains has medias
	if( memberdirectoryportal_post_page() && isset($apidata->medias) && is_array($apidata->medias) && count($apidata->medias)) {

		wp_enqueue_style( 
			'member-directoryportal-slick', 
			MDP_PLUGIN_URI . "assets/slick/slick.css"
		);
	
		wp_enqueue_script( 
			'member-directoryportal-slick', 
			MDP_PLUGIN_URI . "assets/slick/slick.js", 
			array(),
			'1.0',
			true  
		);
	}


	if( memberdirectoryportal_post_page() && isset( $apidata->event )) {
		wp_enqueue_script( 
			'member-directoryportal-script', 
			MDP_PLUGIN_URI . "assets/add-cal.js", 
			array(),
			'1.0',
			true 
		);
	
		wp_enqueue_style( 
			'member-directoryportal-add-cal', 
			MDP_PLUGIN_URI . "assets/add-cal.css"
		);
	
		wp_enqueue_script( 
			'member-directoryportal-add-cal', 
			MDP_PLUGIN_URI . "assets/add-cal.js", 
			array(),
			'1.0',
			true  
		);
	}


	# if content contains shortcode filter
	if( str_contains( $post->post_content, "[mdpsc_filter" ) ) {
		wp_enqueue_script( 
			'member-directoryportal-post', 
			MDP_PLUGIN_URI . "assets/scripts/mdpsc_filter.js", 
			array(),
			'1.0',
			true 
		);
	}

}