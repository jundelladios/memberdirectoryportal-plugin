<?php

function memberdirectoryportal_post_upsert( $payload ) {
  global $user_ID;

  $title = $payload['title'] ? $payload['title'] : wp_trim_words( $payload['caption'], 5, "" );
  $slug = sanitize_title($title);

  $channels = get_posts(array(
    'post_type'     => 'mdp_channels',
    'meta_key' => 'mdp_channel_id',
    'meta_value' => $payload['channel']['id']
  ));

  if(!count($channels)) {
    return new WP_REST_Response(array('error' => true), 400);
  }

  $postChannel = $channels[0];
  $posttype = 'mdp_channel_' . $postChannel->ID;
  $metapostkey = "mdp_post_id";

  $posts = get_posts(array(
    'post_type'     => $posttype,
    'meta_key' => $metapostkey,
    'meta_value' => $payload['id']
  ));

  $args = array(
    'post_title' => $title,
    'post_content' => $payload['caption'],
    'post_status' => 'publish',
    'post_date' => date('Y-m-d H:i:s'),
    'post_author' => $user_ID,
    'post_type' => $posttype,
    'post_name' => $slug
  );

  if(count($posts)) {
    $post = $posts[0];
    if(!$payload['channel']['is_post_feed']) { 
      wp_delete_post( $post->ID, true );
      return false; 
    }
    $args['ID'] = $post->ID;
    $post_id = wp_update_post($args);
  } else {
    $post_id = wp_insert_post($args);
  }

  if($post_id) {

    // categories
    $categories = $payload['categories'];
    $ids = [];
    foreach( $categories as $cat ) {
      $ids[] = $cat['channel_category']['id'];
    }
    $taxonomy = $posttype."_category";
    $metakey = "mdp_channel_category_id";
    memberdirectoryportal_post_taxonomy_set( $post_id, $ids, $metakey, $taxonomy );
    
    // tags
    $tags = $payload['tags'];
    $ids = [];
    foreach( $tags as $cat ) {
      $ids[] = $cat['channel_tag']['id'];
    }
    $taxonomy = $posttype."_tag";
    $metakey = "mdp_channel_tag_id";
    memberdirectoryportal_post_taxonomy_set( $post_id, $ids, $metakey, $taxonomy );

    update_post_meta( $post_id, $metapostkey, $payload['id'] );
    update_post_meta( $post_id, 'mdp_data', json_encode($payload) );

    // post meta setter
    memberdirectoryportal_mpdata_postmeta( $post_id, $payload );

    return new WP_REST_Response(array('success' => "POST ID: " . $post_id), 200);
  }
}