<?php

function memberdirectoryportal_delete_member( $payload ) {
  $posts = get_posts(array(
    'numberposts'   => -1,
    'post_type'     => 'mdp_members',
    'meta_key' => 'mdp_member_id',
    'meta_value' => $payload['id']
  ));
  if(count($posts)) {
    $post = $posts[0];
    wp_delete_post( $post->ID, true );
  }

  return new WP_REST_Response(array('success' => "OK"), 200);
}