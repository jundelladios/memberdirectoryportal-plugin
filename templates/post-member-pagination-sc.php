<?php

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array( 
  'posts_per_page' => $atts['limit'], 
  'paged' => $paged,
  'post_type' => 'mdp_members'
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
    'taxonomy' => "mdp_members_category",
    'field' => 'slug',
    'terms' => explode(",", $categories)
  );
}

if($tags) {
  $args['tax_query'][] = array(
    'taxonomy' => "mdp_members_tag",
    'field' => 'slug',
    'terms' => explode(",", $tags)
  );
}

if($search) {
  $args['s'] = $search;
}

$metaqueries = array(
  array(
    'key' => 'mdp_data_user_address1',
    'value' => $address
  ),
  array(
    'key' => 'mdp_data_user_city',
    'value' => $city
  ),
  array(
    'key' => 'mdp_data_user_state',
    'value' => $state
  ),
  array(
    'key' => 'mdp_data_user_country',
    'value' => $country
  ),
  array(
    'key' => 'mdp_data_user_postal_code',
    'value' => $zip
  ),
  array(
    'key' => 'mdp_data_user_contact_phone',
    'value' => $phone
  ),
  array(
    'key' => 'mdp_data_user_email',
    'value' => $email
  ),
  array(
    'key' => 'mdp_data_user_website',
    'value' => $website
  )
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

?>

<div class="mdp mdp-container">
<?php
$postslist = new WP_Query( $args );
if ( $postslist->have_posts() ) :
  while ( $postslist->have_posts() ) : $postslist->the_post(); 
    include MDP_PLUGIN_DIR . 'templates/member-archive-post.php';
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