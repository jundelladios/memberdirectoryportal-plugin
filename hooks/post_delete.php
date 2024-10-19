<?php

function memberdirectoryportal_post_delete( $payload ) {

  $channels = get_posts(array(
    'post_type'     => 'mdp_channels',
    'meta_key' => 'mdp_channel_id',
    'meta_value' => $payload['channelId']
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

  if(count($posts)) {
    $post = $posts[0];
    wp_delete_post( $post->ID, true );
  }

  return new WP_REST_Response(array('success' => "OK"), 200);
}