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

    // clear cache
    clean_taxonomy_cache( "mdp_members_category" );
    clean_taxonomy_cache( "mdp_members_tag" );
    memberdirectoryportal_clean_shortcode_cache('mdpsc_member_feed');
  }

  return new WP_REST_Response(array('success' => "OK"), 200);
}