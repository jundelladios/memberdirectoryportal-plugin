<?php

function memberdirectoryportal_upsert_channel_tag( $payload ) {
  $posts = get_posts(array(
    'numberposts'   => -1,
    'post_type'     => 'mdp_channels',
    'meta_key' => 'mdp_channel_id',
    'meta_value' => $payload['channel']['id']
  ));

  $title = $payload['tag'];
  $metakey = "mdp_channel_tag_id";
  $slug = sanitize_title($title);

  if(count($posts)) {
    $post = $posts[0];
    $post_type = 'mdp_channel_' . $post->ID;
    $taxonomy = $post_type."_tag";

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

    $termId = null;
    if(count($terms)) {
      $term = $terms[0];
      $term = wp_update_term($term->term_id, $taxonomy, array(
        'name' => $title,
        'slug' => $slug
      ));
      $termId = $term['term_id'];
    } else {
      $term = wp_insert_term(
        $title,
        $taxonomy,
        array(
          'slug' => $slug,
        )
      );
      $termId = $term['term_id'];
    }

    if($termId) {
      update_term_meta( $termId, $metakey, $payload['id'] );
      update_term_meta( $termId, "mdp_data", addslashes(json_encode($payload)) );

      // clean cache
      clean_term_cache( $termId, $taxonomy );
      memberdirectoryportal_clean_shortcode_cache("mdpsc_filter_channel");
      
      return new WP_REST_Response(array('success' => "TERM ID: " . $termId), 200);
    }
  }

  return new WP_REST_Response(array('error' => true), 400);
}