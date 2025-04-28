<?php

function memberdirectoryportal_upsert_channel( $payload ) {

  global $user_ID;
  $posts = get_posts(array(
    'post_type'     => 'mdp_channels',
    'meta_key' => 'mdp_channel_id',
    'meta_value' => $payload['id']
  ));

  $args = array(
    'post_title' => $payload['name'],
    'post_content' => "",
    'post_status' => 'publish',
    //'post_date' => date('Y-m-d H:i:s'), commented out to prevent post set as SCHEDULED
    'post_author' => $user_ID,
    'post_type' => 'mdp_channels',
    'post_name' => $payload['slug']
  );

  if(count($posts)) {
    $post = $posts[0];
    if(!$payload['is_post_feed']) { 
      wp_delete_post( $post->ID, true );
      return false; 
    }
    $args['ID'] = $post->ID;
    $post_id = wp_update_post($args);
  } else {
    $post_id = wp_insert_post($args);
  }

  if($post_id) {
    update_post_meta( $post_id, 'mdp_channel_id', $payload['id'] );
    update_post_meta( $post_id, 'mdp_data', json_encode($payload) );

    foreach($payload as $key => $value) {
      update_post_meta( $post_id, "mdp_data_$key", memberdirectoryportal_mpdata_value($value) );
    }

    clean_post_cache( $post_id );

    return new WP_REST_Response(array('success' => "POST ID: " . $post_id), 200);
  }

  return new WP_REST_Response(array('error' => true), 400);
}