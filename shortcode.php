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