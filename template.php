<?php

add_filter( 'single_template', 'memberdirectoryportal_member_template', 100);
function memberdirectoryportal_member_template( $template ) {
  global $post;
  global $apidata;
  $apidata = get_post_meta( $post->ID, 'mdp_data', true);
  $apidata = json_decode($apidata);

  if ( $post->post_type == 'mdp_members' ) {
    return MDP_PLUGIN_DIR . 'page-templates/mdp-single-members-template.php';
  }
  if( str_contains($post->post_type, 'mdp_channel_') ) {
    if($apidata->event) {
      return MDP_PLUGIN_DIR . 'page-templates/mdp-single-events-template.php';
    } else if ($apidata->job) {
      return MDP_PLUGIN_DIR . 'page-templates/mdp-single-jobs-template.php';
    } else if ( $apidata->advertisement ) {
      return MDP_PLUGIN_DIR . 'page-templates/mdp-single-advertisement-template.php';
    } else {
      return MDP_PLUGIN_DIR . 'page-templates/mdp-single-posts-template.php';
    }
  }
  return $template;
}


function memberdirectoryportal_archive_template( $archive_template ) {
  $obj = get_queried_object();
  global $apidata;
  $apidata = get_term_meta( $obj->term_id, 'mdp_data', true);
  $apidata = json_decode($apidata);
  if ( in_array( $obj->taxonomy, array( 'mdp_members_category', 'mdp_members_tag') ) ) {
    $archive_template = MDP_PLUGIN_DIR . 'page-templates/mdp-archive-member-template.php';
  }
  if ( str_contains( $obj->taxonomy, 'mdp_channel_' ) ) {
    $archive_template = MDP_PLUGIN_DIR . 'page-templates/mdp-archive-channel-template.php';
  }
  return $archive_template;
}
add_filter( 'archive_template', 'memberdirectoryportal_archive_template' ) ;


function memberdirectoryportal_exerpt( $text="", $more=null, $num_words = 20, $ending="..." ) {
  global $post;
  $excerpt = strip_shortcodes( $text );
  $excerpt = wp_trim_words( $excerpt, $num_words, $ending );
  $moreText = $more ?: 'Continue to ' . get_the_title( $post->ID );
  $excerpt .= '<p><a href="' . get_permalink( $post ) . '" class="mdp-link" aria-label="' . $moreText . '" title="' . $moreText . '">' . $moreText . '</a></p>';
  return $excerpt;
}


// event expiration auto draft if expires
function memberdirectoryportal_autodraft_page_expires() {

  // channels that has expiration auto draft page.
  $channels = get_posts( array(
    'numberposts' => -1,
    'post_type' => 'mdp_channels',
    'meta_query' => array(
      'relation' => 'OR',
      array(
          'key'     => 'mdp_data_category',
          'value'   => 'Events',
          'compare' => '='
      ),
      array(
        'key'     => 'mdp_data_category',
        'value'   => 'Advertising',
        'compare' => '='
      ),
    )
  ));

  $posttypes = [];
  foreach($channels as $ch) {
    $posttypes[] = "mdp_channel_" . $ch->ID;
  }

  $postargs = array(
    'numberposts'   => -1,
    'post_type' => $posttypes,
    "order" => "DESC",
    'post_status' => 'publish',
    'meta_query' => array(
      array(
          'key'     => 'mdp_data_event_end_date',
          'value'   => date('Y-m-d h:i:s'),
          'compare' => '<',
          'type' => 'DATETIME'
      )
    )
  );

  $posts = get_posts($postargs);

  foreach($posts as  $ps) {
    wp_update_post(array(
      'ID' => $ps->ID,
      'post_status' => 'draft'
    ));

    clean_post_cache( $ps );
  }
}
add_action( "wp", "memberdirectoryportal_autodraft_page_expires" );



function memberdirectoryportal_js_dateformat( $format = "Y-m-d H:i:s", $date ) {
  $date = date_create_from_format('D M d Y H:i:s e+', $date);
  return date_format($date, $format);
}