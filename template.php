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


// function memberdirectoryportal_archive_template( $archive_template ) {
//   echo is_post_type_archive ( 'mdp_members' );
//   echo "hello world";
//   if ( is_post_type_archive ( 'mdp_members' ) ) {
//       $archive_template = __DIR__ . '/templates/archive/member.php';
//   }
//   return $archive_template;
// }
// add_filter( 'archive_template', 'memberdirectoryportal_archive_template' ) ;