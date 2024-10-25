<?php

function memberdirectoryportal_field_shortcode($atts) {
  global $post;
  $post_id = $post->ID;
  $atts = shortcode_atts(
    array(
      'field' => ""
    ),
  $atts);
  if(!$atts['field']) { return ""; }
  return get_post_meta( $post_id, $atts['field'], true );
}
add_shortcode('mdpsc', 'memberdirectoryportal_field_shortcode');




function memberdirectoryportal_member_application_shortcode($atts) {
  ob_start();
  ?>
  <iframe src="<?php echo memberdirectoryportal_get_portaldomain(). "/embeds/sign-up"; ?>" width="100%" height="1000" style="width:100%;height:1000px;border:0;overflow-y:auto;display:block;margin:0 auto;"></iframe>
  <?php
  return ob_get_clean();
}
add_shortcode('mdpsc_member_application', 'memberdirectoryportal_member_application_shortcode');



function memberdirectoryportal_member_feed_shortcode($atts) {
  global $post;
  $post_id = $post->ID;

  $atts = shortcode_atts(
    array(
      'limit' => 5
    ),
  $atts);

  $posts = get_posts(array(
    'post_type' => 'mdp_members',
    'numberposts' => $atts['limit']
  ));

  ob_start();
  echo '<div class="mdp mdp-container">';
  foreach( $posts as $post ) {
    include MDP_PLUGIN_DIR . '/templates/archive/member-archive-post.php';
  }
  echo '</div>';

  return ob_get_clean();
}
add_shortcode('mdpsc_member_feed', 'memberdirectoryportal_member_feed_shortcode');



function memberdirectoryportal_feed_shortcode($atts) {
  global $post;
  $post_id = $post->ID;

  $atts = shortcode_atts(
    array(
      'limit' => 5,
      'post_type' => null,
      'pagination' => false
    ),
  $atts);

  if(!$atts['post_type']) { return ""; }

  if($atts['pagination']) {
    ob_start();
      include MDP_PLUGIN_DIR . '/templates/post-feed-pagination-sc.php';
    return ob_get_clean();
  }

  $posts = get_posts(array(
    'post_type' => $atts['post_type'],
    'numberposts' => $atts['limit']
  ));

  ob_start();
  echo '<div class="mdp mdp-container">';
  foreach( $posts as $post ) {
    include MDP_PLUGIN_DIR . '/templates/archive/channel-archive-post.php';
  }
  echo '</div>';

  return ob_get_clean();
}
add_shortcode('mdpsc_feed', 'memberdirectoryportal_feed_shortcode');




function memberdirectoryportal_member_terms_shortcode($atts) {
  $atts = shortcode_atts(
    array(
      'taxonomy' => null
    ),
  $atts);

  if(!$atts['taxonomy']) { return ""; }

  $terms = get_terms(array(
    'taxonomy' => $atts['taxonomy']
  ));
  ob_start();
  echo '<div class="mdp mdp-container">';
  echo '<div class="mdp-term-grid">';
  foreach($terms as $term) {
    include MDP_PLUGIN_DIR . '/templates/term-grid.php';
  }
  echo '</div>';
  echo '</div>';
  return ob_get_clean();
}
add_shortcode('mdpsc_terms', 'memberdirectoryportal_member_terms_shortcode');