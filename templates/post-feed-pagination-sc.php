<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$post_type = $atts['post_type'];
$args = array( 
  'posts_per_page' => $atts['limit'], 
  'paged' => $paged,
  'post_type' => $post_type
);

$categories = get_query_var("categories");
$tags = get_query_var("tags");
$search = get_query_var("search");

$address = get_query_var("address");
$city = get_query_var("city");
$state = get_query_var("state");
$country = get_query_var("country");
$zip = get_query_var("zip");

$phone = get_query_var("phone");
$email = get_query_var("email");
$fax = get_query_var("fax");
$website = get_query_var("website");

if($categories) {
  $args['tax_query'][] = array(
    'taxonomy' => $post_type . '_category',
    'field' => 'slug',
    'terms' => explode(",", $categories)
  );
}

if($tags) {
  $args['tax_query'][] = array(
    'taxonomy' => $post_type . '_tag',
    'field' => 'slug',
    'terms' => explode(",", $tags)
  );
}

if($search) {
  $args['s'] = $search;
}

$metaqueries = array(
  array(
    'key' => 'mdp_data_address1',
    'value' => $address
  ),
  array(
    'key' => 'mdp_data_city',
    'value' => $city
  ),
  array(
    'key' => 'mdp_data_state',
    'value' => $state
  ),
  array(
    'key' => 'mdp_data_country',
    'value' => $country
  ),
  array(
    'key' => 'mdp_data_postal_code',
    'value' => $zip
  ),
  array(
    'key' => 'mdp_data_contact_phone',
    'value' => $phone
  ),
  array(
    'key' => 'mdp_data_contact_email',
    'value' => $email
  ),
  array(
    'key' => 'mdp_data_fax',
    'value' => $fax
  ),
);


foreach($metaqueries as $mq) {
  if($mq['value']) {
    $args['meta_query'][] = array(
      'key' => $mq['key'],
      'value' => $mq['value'],
      'compare' => 'LIKE'
    );
  }
}

if($atts['is_event']) {
  $args['meta_key'] = "mdp_data_event_start_date";
  $args['meta_type'] = "DATETIME";
  $args['orderby'] = "meta_value";
  $args['order'] = "ASC";
}

?>

<div class="mdp mdp-container">
<?php
$postslist = new WP_Query( $args );
if ( $postslist->have_posts() ) :
  while ( $postslist->have_posts() ) : $postslist->the_post(); 
    include MDP_PLUGIN_DIR . 'templates/channel-archive-post.php';
  endwhile;  
  ?>
  <div class="mdp-flex mdp-gap5 mdp-pagination">
  <div class="nav-previous mdp-page-button alignleft"><?php previous_posts_link( 'Previous' ); ?></div>
  <div class="nav-next mdp-page-button alignright"><?php next_posts_link( 'Next', $postslist->max_num_pages ); ?></div>
  <?php
  wp_reset_postdata();
else:
  if( $atts['empty_text']): 
  ?>
  <p class="mdp-empty-sc"><?php echo $atts['empty_text']; ?></p>
  <?php
  endif;
endif;
?>
</div>