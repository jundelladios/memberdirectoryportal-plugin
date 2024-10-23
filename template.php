<?php

add_filter( 'single_template', 'memberdirectoryportal_member_template', 100);
function memberdirectoryportal_member_template( $template ) {
  global $post;
  global $apidata;
  $apidata = get_post_meta( $post->ID, 'mdp_data', true);
  $apidata = json_decode($apidata);
  if ( $post->post_type == 'mdp_members' ) {
    return __DIR__ . '/templates/single/member.php';
  }
  if( str_contains($post->post_type, 'mdp_channel_') ) {
    if($apidata->event) {
      return __DIR__ . '/templates/single/event.php';
    } else if ($apidata->job) {
      return __DIR__ . '/templates/single/job.php';
    } else if ( $apidata->advertisement ) {
      return __DIR__ . '/templates/single/ads.php';
    } else {
      return __DIR__ . '/templates/single/post.php';
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
    $archive_template = __DIR__ . '/templates/archive/member-archive.php';
  }
  if ( str_contains( $obj->taxonomy, 'mdp_channel_' ) ) {
    $archive_template = __DIR__ . '/templates/archive/channel-archive.php';
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