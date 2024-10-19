<?php

add_action( 'admin_bar_menu', 'memberdirectoryportal_adminbar', 999 );
function memberdirectoryportal_adminbar( $wp ) {
    $request = wp_remote_get( memberdirectoryportal_get_portalmain() . "/api/trpc/connector.connectedIntegrations", array(
      'headers' => array(
        "X-REQUEST-HOMEURL-HOST" => home_url()
      )
    ) );
    $data = wp_remote_retrieve_body($request);
    $response = json_decode($data);
    $url = isset($response->result->data->json->redirect) ? $response->result->data->json->redirect : null;
    $title = "MDP: ";
    $title .= $url ? "Connected" : "Not Connected";
    $args = array(
      'id'    => 'member_directory_portal',
      'title' => $title,
      'href'  => $url,
      'meta'  => array( 'class' => 'member-directory-portal', 'target' => '_blank' )
  );

  if(isset($response->result->data->json->integration->group->location_id)) {
    update_option( 'mdp_location_id', $response->result->data->json->integration->group->location_id );
  }

  $wp->add_node( $args );
}


function memberdirectoryportal_get_portalmain() {
  if(defined('MDP_DEVELOPMENT')) {
    return "http://localhost:3000";
  }
  return "https://member-directoryportal.com";
}

function memberdirectoryportal_get_portaldomain() {
  if(defined('MDP_DEVELOPMENT')) {
    return "http://localhost:3000";
  }
  $locationId = get_option( 'mdp_location_id' );
  return "https://$locationId.member-directoryportal.com";
}