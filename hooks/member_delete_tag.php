<?php

function memberdirectoryportal_delete_member_tag( $payload ) {
  $taxonomy = "mdp_members_tag";
  $metakey = "mdp_members_tag_id";

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

  return new WP_REST_Response(array('success' => "OK"), 200);
}