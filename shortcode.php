<?php

function memberdirectoryportal_empty_sc() {
  return __("There's no result from search directory.");
}

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
      'limit' => get_option( 'posts_per_page' ),
      'pagination' => false,
      'empty_text' => memberdirectoryportal_empty_sc()
    ),
  $atts);

  if($atts['pagination']) {
    ob_start();
      include MDP_PLUGIN_DIR . 'templates/post-member-pagination-sc.php';
    return ob_get_clean();
  }

  $posts = get_posts(array(
    'post_type' => 'mdp_members',
    'numberposts' => $atts['limit']
  ));

  ob_start();
  echo '<div class="mdp mdp-container">';
  foreach( $posts as $post ) {
    include MDP_PLUGIN_DIR . 'templates/member-archive-post.php';
  }

  if(!count($posts) && $atts['empty_text']) {
    echo '<p class="mdp-empty-sc">' . $atts['empty_text'] . '</p>';
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
      'limit' => get_option( 'posts_per_page' ),
      'post_type' => null,
      'pagination' => false,
      'empty_text' => memberdirectoryportal_empty_sc(),
      'is_event' => false
    ),
  $atts);

  if(!$atts['post_type']) { return ""; }

  if($atts['pagination']) {
    ob_start();
      include MDP_PLUGIN_DIR . 'templates/post-feed-pagination-sc.php';
    return ob_get_clean();
  }


  $postArgs = array(
    'post_type' => $atts['post_type'],
    'numberposts' => $atts['limit']
  );

  if($atts['is_event']) {
    $postArgs['meta_key'] = "mdp_data_event_start_date";
    $postArgs['meta_type'] = "DATETIME";
    $postArgs['orderby'] = "meta_value";
    $postArgs['order'] = "ASC";
  }

  $posts = get_posts($postArgs);

  ob_start();
  echo '<div class="mdp mdp-container">';
  foreach( $posts as $post ) {
    include MDP_PLUGIN_DIR . 'templates/channel-archive-post.php';
  }

  if(!count($posts) && $atts['empty_text']) {
    echo '<p class="mdp-empty-sc">' . $atts['empty_text'] . '</p>';
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
    'taxonomy' => $atts['taxonomy'],
    'hide_empty' => false
  ));
  ob_start();
  echo '<div class="mdp mdp-container">';
  echo '<div class="mdp-term-grid">';
  foreach($terms as $term) {
    include MDP_PLUGIN_DIR . 'templates/term-grid.php';
  }
  echo '</div>';
  echo '</div>';
  return ob_get_clean();
}
add_shortcode('mdpsc_terms', 'memberdirectoryportal_member_terms_shortcode');


function memberdirectoryportal_feed_filter_channel($atts) {
  global $wp;
  $atts = shortcode_atts(
    array(
      'post_type' => null,
      'redirect' => home_url( $wp->request )
    ),
  $atts);
  if(!$atts['post_type']) { return ""; }
  ob_start();
  include MDP_PLUGIN_DIR . 'templates/filter-channel.php';
  return ob_get_clean();
}
add_shortcode('mdpsc_filter_channel', 'memberdirectoryportal_feed_filter_channel');


function memberdirectoryportal_feed_filter_member($atts) {
  global $wp;
  $atts = shortcode_atts(
    array(
      'redirect' => home_url( $wp->request )
    ),
  $atts);
  ob_start();
  include MDP_PLUGIN_DIR . 'templates/filter-member.php';
  return ob_get_clean();
}
add_shortcode('mdpsc_filter_member', 'memberdirectoryportal_feed_filter_member');


function memberdirectoryportal_clean_shortcode_cache( $shortcode = "mdpsc_" ) {
  global $wpdb;
  $posts = $wpdb->get_results("SELECT ID FROM {$wpdb->posts} WHERE post_content LIKE '%[{$shortcode}%'", ARRAY_A);
  foreach($posts as $postsc) {
    $postscId = (int) $postsc['ID'];
    if(function_exists('clean_post_cache')) {
      clean_post_cache($postscId);
    }
  }
}