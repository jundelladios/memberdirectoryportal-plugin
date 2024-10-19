<?php

function memberdirectoryportal_upsert_member( $payload ) {

  global $user_ID;

  if(!$payload['user']['company']) {
    return new WP_REST_Response(array('error' => true), 400);
  }

  $title = $payload['user']['company'];
  $slug = sanitize_title($title);

  $posts = get_posts(array(
    'post_type'     => 'mdp_members',
    'meta_key' => 'mdp_member_id',
    'meta_value' => $payload['id']
  ));

  $args = array(
    'post_title' => $title,
    'post_content' => "",
    'post_status' => 'publish',
    'post_date' => date('Y-m-d H:i:s'),
    'post_author' => $user_ID,
    'post_type' => 'mdp_members',
    'post_name' => $slug
  );

  if(count($posts)) {
    $post = $posts[0];
    $args['ID'] = $post->ID;
    $post_id = wp_update_post($args);
  } else {
    $post_id = wp_insert_post($args);
  }

  if($post_id) {

    // categories
    $categories = $payload['user']['usercategories'];
    $ids = [];
    foreach( $categories as $cat ) {
      $ids[] = $cat['category']['id'];
    }
    $taxonomy = "mdp_members_category";
    $metakey = "mdp_members_category_id";
    memberdirectoryportal_post_taxonomy_set( $post_id, $ids, $metakey, $taxonomy );
    
    // tags
    $tags = $payload['user']['usertags'];
    $ids = [];
    foreach( $tags as $cat ) {
      $ids[] = $cat['tag']['id'];
    }
    $taxonomy = "mdp_members_tag";
    $metakey = "mdp_members_tag_id";
    memberdirectoryportal_post_taxonomy_set( $post_id, $ids, $metakey, $taxonomy );

    
    update_post_meta( $post_id, 'mdp_member_id', $payload['id'] );
    update_post_meta( $post_id, 'mdp_data', json_encode($payload) );


    // post meta setter
    memberdirectoryportal_mpdata_postmeta( $post_id, $payload );

    return new WP_REST_Response(array('success' => "POST ID: " . $post_id), 200);
  }

  return new WP_REST_Response(array('error' => true), 400);
}