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