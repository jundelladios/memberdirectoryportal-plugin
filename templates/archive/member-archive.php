<?php 
wp_head();
?>

<div class="mdp-archive-title mdp-padding">
  <h1 class="mdp-textcenter"><?php echo single_term_title(); ?></h1>
</div>

<div class="mdp mdp-container">
  <?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post();  ?>
  <?php include MDP_PLUGIN_DIR . '/templates/archive/member-archive-post.php'; ?>
  <?php endwhile; ?>

  <div class="mdp-flex mdp-gap5 mdp-pagination">
  <div class="nav-previous mdp-page-button alignleft"><?php previous_posts_link( 'Previous' ); ?></div>
  <div class="nav-next mdp-page-button alignright"><?php next_posts_link( 'Next' ); ?></div>
  </div>

  <?php else : ?>
  <p><?php _e('Sorry, no ' . strtolower(single_term_title()) . ' matched your criteria.'); ?></p>
  <?php endif; ?>
</div>

<?php
wp_footer();