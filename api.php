<?php

add_action( 'rest_api_init', function () {
  register_rest_route( 'memberdirectoryportal', 'template/channels', array(
    'methods' => 'GET',
    'callback' => 'memberdirectoryportal_template_channel',
    'permission_callback' => '__return_true'
  ));
});


add_action( 'rest_api_init', function () {
  register_rest_route( 'memberdirectoryportal', 'template/members', array(
    'methods' => 'GET',
    'callback' => 'memberdirectoryportal_template_members',
    'permission_callback' => '__return_true'
  ));
});


function memberdirectoryportal_template_channel( $request ) {

  $page = $request['page'] ?? 1;
  $limit = $request['limit'] ?? get_option( 'posts_per_page' );
  $post_type = $request['post_type'];

  $categories = $request['categories'];
  $tags = $request['tags'];
  $search = $request['s'];

  $address = $request['address'];
  $city = $request['city'];
  $state = $request['state'];
  $country = $request['country'];
  $zip = $request['zip'];

  $phone = $request['phone'];
  $email = $request['email'];
  $fax = $request['fax'];

  if(!$post_type) { return ""; }

  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $args = array( 
    'posts_per_page' => $limit, 
    'paged' => $page,
    'post_type' => $post_type
  );

  if($categories) {
    $args['tax_query'][] = array(
      'taxonomy' => $post_type . '_category',
      'field' => 'slug',
      'terms' => explode(",", $categories)
    );
  }

  if($tags) {
    $args['tax_query'][] = array(
      'taxonomy' => $post_type . '_tag',
      'field' => 'slug',
      'terms' => explode(",", $tags)
    );
  }

  if($search) {
    $args['s'] = $search;
  }

  $metaqueries = array(
    array(
      'key' => 'mdp_data_address1',
      'value' => $address
    ),
    array(
      'key' => 'mdp_data_city',
      'value' => $city
    ),
    array(
      'key' => 'mdp_data_state',
      'value' => $state
    ),
    array(
      'key' => 'mdp_data_country',
      'value' => $country
    ),
    array(
      'key' => 'mdp_data_postal_code',
      'value' => $zip
    ),
    array(
      'key' => 'mdp_data_contact_phone',
      'value' => $phone
    ),
    array(
      'key' => 'mdp_data_contact_email',
      'value' => $email
    ),
    array(
      'key' => 'mdp_data_fax',
      'value' => $fax
    ),
  );


  foreach($metaqueries as $mq) {
    if($mq['value']) {
      $args['meta_query'][] = array(
        'key' => $mq['key'],
        'value' => $mq['value'],
        'compare' => 'LIKE'
      );
    }
  }

  ob_start();
  ?>
  
  <div class="mdp mdp-container">
  <?php
  $postslist = new WP_Query( $args );
  if ( $postslist->have_posts() ) :
    while ( $postslist->have_posts() ) : $postslist->the_post(); 
      include MDP_PLUGIN_DIR . 'templates/channel-archive-post.php';
    endwhile;  
    ?>
    <div class="mdp-flex mdp-gap5 mdp-pagination">
    <div class="nav-previous mdp-page-button alignleft"><?php previous_posts_link( 'Previous' ); ?></div>
    <div class="nav-next mdp-page-button alignright"><?php next_posts_link( 'Next', $postslist->max_num_pages ); ?></div>
    <?php
    wp_reset_postdata();
  endif;
  ?>
  </div>

  <?php
  return ob_get_clean();
}



function memberdirectoryportal_template_members( $request ) {

  $page = $request['page'] ?? 1;
  $limit = $request['limit'] ?? get_option( 'posts_per_page' );
  $post_type = "mdp_members";
  $categories = $request['categories'];
  $tags = $request['tags'];
  $search = $request['s'];

  $address = $request['address'];
  $city = $request['city'];
  $state = $request['state'];
  $country = $request['country'];
  $zip = $request['zip'];

  $phone = $request['phone'];
  $email = $request['email'];
  $website = $request['website'];

  if(!$post_type) { return ""; }

  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $args = array( 
    'posts_per_page' => $limit, 
    'paged' => $page,
    'post_type' => $post_type
  );

  if($categories) {
    $args['tax_query'][] = array(
      'taxonomy' => "mdp_members_category",
      'field' => 'slug',
      'terms' => explode(",", $categories)
    );
  }

  if($tags) {
    $args['tax_query'][] = array(
      'taxonomy' => "mdp_members_tag",
      'field' => 'slug',
      'terms' => explode(",", $tags)
    );
  }

  if($search) {
    $args['s'] = $search;
  }

  $metaqueries = array(
    array(
      'key' => 'mdp_data_user_address1',
      'value' => $address
    ),
    array(
      'key' => 'mdp_data_user_city',
      'value' => $city
    ),
    array(
      'key' => 'mdp_data_user_state',
      'value' => $state
    ),
    array(
      'key' => 'mdp_data_user_country',
      'value' => $country
    ),
    array(
      'key' => 'mdp_data_user_postal_code',
      'value' => $zip
    ),
    array(
      'key' => 'mdp_data_user_contact_phone',
      'value' => $phone
    ),
    array(
      'key' => 'mdp_data_user_email',
      'value' => $email
    ),
    array(
      'key' => 'mdp_data_user_website',
      'value' => $website
    )
  );


  foreach($metaqueries as $mq) {
    if($mq['value']) {
      $args['meta_query'][] = array(
        'key' => $mq['key'],
        'value' => $mq['value'],
        'compare' => 'LIKE'
      );
    }
  }

  ob_start();
  ?>
  
  <div class="mdp mdp-container">
  <?php
  $postslist = new WP_Query( $args );
  if ( $postslist->have_posts() ) :
    while ( $postslist->have_posts() ) : $postslist->the_post(); 
      include MDP_PLUGIN_DIR . 'templates/member-archive-post.php';
    endwhile;  
    ?>
    <div class="mdp-flex mdp-gap5 mdp-pagination">
    <div class="nav-previous mdp-page-button alignleft"><?php previous_posts_link( 'Previous' ); ?></div>
    <div class="nav-next mdp-page-button alignright"><?php next_posts_link( 'Next', $postslist->max_num_pages ); ?></div>
    <?php
    wp_reset_postdata();
  endif;
  ?>
  </div>

  <?php
  return ob_get_clean();
}