<?php

function memberdirectoryportal_delete_channel( $payload ) {
  $posts = get_posts(array(
    'numberposts'   => -1,
    'post_type'     => 'mdp_channels',
    'meta_key' => 'mdp_channel_id',
    'meta_value' => $payload['id']
  ));
  if(count($posts)) {
    $post = $posts[0];
    wp_delete_post( $post->ID, true );

    // delete all posts related to this channel including clearing it's caches
    $posttype = 'mdp_channel_' . $post->ID;
    $channelPosts = get_posts( array('post_type' => $posttype, 'numberposts' => -1) );
    foreach ($channelPosts as $eachpost) {
      wp_delete_post( $eachpost->ID, true );
    }
  }

  return new WP_REST_Response(array('success' => "OK"), 200);
}