<?php

function memberdirectoryportal_delete_channel_category( $payload ) {

  $posts = get_posts(array(
    'numberposts'   => -1,
    'post_type'     => 'mdp_channels',
    'meta_key' => 'mdp_channel_id',
    'meta_value' => $payload['channelId']
  ));

  $metakey = "mdp_channel_category_id";

  if(count($posts)) {
    $post = $posts[0];
    $post_type = 'mdp_channel_' . $post->ID;
    $taxonomy = $post_type."_category";

    $terms = get_terms(array(
      'taxonomy' => $taxonomy,
      'hide_empty' => false,
      'meta_query' => array(
        array(
          'key' => $metakey,
          'value' => $payload['id'],
          'compare' => '='
        )
      )
    ));

    if(count($terms)) {
      $term = $terms[0];
      wp_delete_term( $term->term_id, $taxonomy );
    }
  }

  return new WP_REST_Response(array('success' => "OK"), 200);
}