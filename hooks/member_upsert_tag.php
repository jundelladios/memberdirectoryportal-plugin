<?php

function memberdirectoryportal_upsert_member_tag( $payload ) {
  $taxonomy = "mdp_members_tag";
  $metakey = "mdp_members_tag_id";

  $title = $payload['tag'];
  $slug = sanitize_title($title);

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
    update_term_meta( $termId, "mdp_data", json_encode($payload) );

    // clean cache
    clean_term_cache( $termId, $taxonomy );
    memberdirectoryportal_clean_shortcode_cache("mdpsc_filter_member");

    return new WP_REST_Response(array('success' => "TERM ID: " . $termId), 200);
  }

  return new WP_REST_Response(array('error' => true), 400);
}