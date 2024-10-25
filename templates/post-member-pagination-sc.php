<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array( 
  'posts_per_page' => $atts['limit'], 
  'paged' => $paged,
  'post_type' => 'mdp_members'
);
?>

<div class="mdp mdp-container">
<?php
$postslist = new WP_Query( $args );
if ( $postslist->have_posts() ) :
  while ( $postslist->have_posts() ) : $postslist->the_post(); 
    include MDP_PLUGIN_DIR . '/templates/archive/member-archive-post.php';
  endwhile;  
  ?>
  <div class="mdp-flex mdp-gap5 mdp-pagination">
  <div class="nav-previous mdp-page-button alignleft"><?php previous_posts_link( 'Previous' ); ?></div>
  <div class="nav-next mdp-page-button alignright"><?php next_posts_link( 'Next', $postslist->max_num_pages ); ?></div>
  <?php
  wp_reset_postdata();
endif;
?>
</div>