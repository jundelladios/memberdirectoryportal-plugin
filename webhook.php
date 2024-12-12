<?php

add_action( 'rest_api_init', function () {
  register_rest_route( 'memberdirectoryportal', 'webhook', array(
    'methods' => 'POST',
    'callback' => 'memberdirectoryportal_webhook',
    'permission_callback' => function() {
      return current_user_can('edit_others_posts');
    }
  ));
});

function memberdirectoryportal_post_taxonomy_set( $post_id, $ids, $metakey, $taxonomy ) {
  // set post term
  $terms = get_terms(array(
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
    'meta_query' => array(
      array(
        'key' => $metakey,
        'value' => $ids,
        'compare' => 'IN'
      )
    )
  ));
  $termIds = [];
  foreach($terms as $trm) {
    $termIds[] = $trm->term_id;
  }
  wp_set_post_terms( $post_id, $termIds, $taxonomy );

  // remove term not in list
  $dterms = get_terms(array(
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
    'meta_query' => array(
      array(
        'key' => $metakey,
        'value' => $ids,
        'compare' => 'NOT IN'
      )
    )
  ));

  $dtermIds = [];
  foreach($dterms as $trm) {
    $dtermIds[] = $trm->term_id;
  }
  wp_remove_object_terms( $post_id, $dtermIds, $taxonomy );
  
}

function memberdirectoryportal_mpdata_value( $value ) {
  $theval = is_null($value) ? "" : $value;
  return is_array( $theval ) || is_object( $theval ) ? json_encode($theval) : $theval;
}

function memberdirectoryportal_mpdata_postmeta( $post_id, $payload ) {
  foreach($payload as $key => $value) {
    update_post_meta( $post_id, "mdp_data_$key", memberdirectoryportal_mpdata_value($value) );
  }

  if(isset($payload['event'])) {
    foreach($payload['event'] as $key => $value) {
      update_post_meta( $post_id, "mdp_data_event_$key", memberdirectoryportal_mpdata_value($value) );
    }
  }

  if(isset($payload['job'])) {
    foreach($payload['job'] as $key => $value) {
      update_post_meta( $post_id, "mdp_data_job_$key", memberdirectoryportal_mpdata_value($value) );
    }
  }

  if(isset($payload['advertisement'])) {
    foreach($payload['advertisement'] as $key => $value) {
      update_post_meta( $post_id, "mdp_data_advertisement_$key", memberdirectoryportal_mpdata_value($value) );
    }
  }

  if(isset($payload['user'])) {
    foreach($payload['user'] as $key => $value) {
      update_post_meta( $post_id, "mdp_data_user_$key", memberdirectoryportal_mpdata_value($value) );
    }
  }
}


function memberdirectoryportal_webhook( $request ) {
  $type = $request['type'];
  $payload = $request['payload'];

  switch($type) {
    
    case "check":
      return new WP_REST_Response(array('success' => "OK"), 200);
    break;

    case "post_upsert":
      return memberdirectoryportal_post_upsert( $payload );
    break;
    
    case "post_delete":
      return memberdirectoryportal_post_delete( $payload );
    break;



    case "channel_upsert":
      return memberdirectoryportal_upsert_channel( $payload );
    break;

    case "channel_delete":
      return memberdirectoryportal_delete_channel( $payload );
    break;




    case "channel_category_upsert":
      return memberdirectoryportal_upsert_channel_category( $payload );
    break;

    case "channel_category_delete":
      return memberdirectoryportal_delete_channel_category( $payload );
    break;




    case "channel_tag_upsert":
      return memberdirectoryportal_upsert_channel_tag( $payload );
    break;

    case "channel_tag_delete":
      return memberdirectoryportal_delete_channel_tag( $payload );
    break;



    
    case "member_upsert":
      return memberdirectoryportal_upsert_member( $payload );
    break;

    case "member_delete":
      return memberdirectoryportal_delete_member( $payload );
    break;




    case "member_category_upsert":
      return memberdirectoryportal_upsert_member_category( $payload );
    break;

    case "member_category_delete":
      return memberdirectoryportal_delete_member_category( $payload );
    break;



    case "member_tag_upsert":
      return memberdirectoryportal_upsert_member_tag( $payload );
    break;

    case "member_tag_delete":
      return memberdirectoryportal_delete_member_tag( $payload );
    break;
  }

  return new WP_REST_Response(array('error' => 'Webhook type is invalid'), 400);
}