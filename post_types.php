<?php

function memberdirectoryportal_channels_posttypes() {
  // member directory chanel post type management
  register_post_type('mdp_channels',
    array(
      'labels' => array(
        'name' => __('Member Directory Channels'),
        'singular_name' => __('Member Directory Channel')
      ),
      'menu_icon' => 'dashicons-plugins-checked',
      'public' => false,
      'has_archive' => true,
      'show_in_rest' => true,
      'rest_base' => 'mdp_channels',
      'supports' => array('title', 'editor', 'custom-fields')
    )
  );


  // mdb members
  register_post_type('mdp_members',
    array(
      'labels' => array(
        'name' => __('Members'),
        'singular_name' => __('Member')
      ),
      'menu_icon' => 'dashicons-plugins-checked',
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true,
      'query_var' => true,
      'rest_base' => 'mdp_members',
      'supports' => array('title', 'editor', 'custom-fields'),
      'rewrite' => array(
        'slug' => 'member',
      )
    )
  );

  register_taxonomy(
    'mdp_members_category',
    'mdp_members',
    array(
      'hierarchical' => true,
      'label' => 'Member Categories',
      'query_var' => true,
      'show_in_rest' => true,
      'rewrite' => array(
        'slug' => 'member-directory-categories',
        'with_front' => false
      )
    )
  );
  register_taxonomy_for_object_type( 'mdp_members_category', 'mdp_members' );


  register_taxonomy(
    'mdp_members_tag',
    'mdp_members',
    array(
      'label' => 'Member Tags',
      'query_var' => true,
      'show_in_rest' => true,
      'rewrite' => array(
        'slug' => 'member-directory-tags',
        'with_front' => false
      )
    )
  );
  register_taxonomy_for_object_type( 'mdp_members_tag', 'mdp_members' );
  

  // mdp channels
  $mdpChannels = get_posts(array(
    'numberposts'   => -1,
    'post_type'     => 'mdp_channels'
  ));

  foreach($mdpChannels as $posttypes) {

    $posttype = 'mdp_channel_' . $posttypes->ID;

    register_post_type($posttype,
      array(
        'labels' => array(
          'name' => __($posttypes->post_title),
          'singular_name' => __($posttypes->post_title)
        ),
        'rewrite' => array('slug' => $posttypes->post_name, 'with_front' => false),
        'menu_icon' => 'dashicons-plugins-checked',
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'rest_base' => 'mdp_channels_' . $posttypes->ID,
        'supports' => array('title', 'editor', 'custom-fields')
      )
    );

    register_taxonomy(
      $posttype."_category",
      $posttype,
      array(
        'hierarchical' => true,
        'label' => $posttypes->post_title . ' Categories',
        'query_var' => true,
        'show_in_rest' => true,
        'rewrite' => array(
          'slug' => $posttypes->post_name . '-categories',
          'with_front' => false
        )
      )
    );
    register_taxonomy_for_object_type( $posttype."_category", $posttype );
  
  
    register_taxonomy(
      $posttype."_tag",
      $posttype,
      array(
        'label' => $posttypes->post_title . ' Tags',
        'query_var' => true,
        'show_in_rest' => true,
        'rewrite' => array(
          'slug' => $posttypes->post_name . '-tags',
          'with_front' => false
        )
      )
    );
    register_taxonomy_for_object_type( $posttype."_tag", $posttype );

  }
}
add_action('init', 'memberdirectoryportal_channels_posttypes');