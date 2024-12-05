<?php

function memberdirectoryportal_post_upsert( $payload ) {
  global $user_ID;

  $title = $payload['title'] ? $payload['title'] : wp_trim_words( wp_strip_all_tags( urldecode($payload['caption']) ), 10, "..." );
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
    'meta_value' => (int) $payload['id'],
    'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash')
  ));

  $args = array(
    'post_title' => $title,
    'post_content' => wp_strip_all_tags(urldecode($payload['caption'])),
    'post_status' => $payload['status'] == 1 ? 'publish' : "pending",
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
    if($payload['status'] !== 1) {
      return new WP_REST_Response(array('success' => "Post not approved."), 200);
    }
    $post_id = wp_insert_post($args);
  }

  if($post_id) {

    // categories
    $categories = $payload['categories'];
    $ids = [];
    foreach( $categories as $cat ) {
      $ids[] = $cat['channel_category']['id'];
    }
    $taxonomyCat = $posttype."_category";
    $metakey = "mdp_channel_category_id";
    memberdirectoryportal_post_taxonomy_set( $post_id, $ids, $metakey, $taxonomyCat );
    
    // tags
    $tags = $payload['tags'];
    $ids = [];
    foreach( $tags as $cat ) {
      $ids[] = $cat['channel_tag']['id'];
    }
    $taxonomyTag = $posttype."_tag";
    $metakey = "mdp_channel_tag_id";
    memberdirectoryportal_post_taxonomy_set( $post_id, $ids, $metakey, $taxonomyTag );

    update_post_meta( $post_id, $metapostkey, $payload['id'] );
    update_post_meta( $post_id, 'mdp_data', json_encode($payload) );
    
    // post meta setter
    memberdirectoryportal_mpdata_postmeta( $post_id, $payload );


    // auto draft if page expires
    memberdirectoryportal_autodraft_page_expires();

    // clear caches
    clean_post_cache( $post_id );

    // remove post if it is not approve.
    // if($payload['status'] !== 1) {
    //   wp_delete_post( $post_id, true );
    // }

    clean_taxonomy_cache( $taxonomyCat );
    clean_taxonomy_cache( $taxonomyTag );
    memberdirectoryportal_clean_shortcode_cache('mdpsc_feed');

    return new WP_REST_Response(array('success' => "POST ID: " . $post_id), 200);
  }
}