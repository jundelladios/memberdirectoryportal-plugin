<?php

add_action( 'wp_enqueue_scripts', 'theme_slug_enqueue_styles' );

function theme_slug_enqueue_styles() {

	wp_enqueue_script('jquery');

  wp_enqueue_style( 
		'member-directoryportal-style', 
		MDP_PLUGIN_URI . "assets/style.css"
	);

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

	wp_enqueue_script( 
		'member-directoryportal-script', 
		MDP_PLUGIN_URI . "assets/script.js", 
		array(),
		'1.0',
		true 
	);

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