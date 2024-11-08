<?php 
/**
 * Template Name: MDP Channel Archive Template
 */

get_header();
?>
<section class="mdp-template-main">

  <div class="mdp-archive-title mdp-padding">
    <h1 class="mdp-textcenter"><?php echo single_term_title("", false); ?></h1>
  </div>

  <div class="mdp mdp-container">
    <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post();  ?>
    <?php include MDP_PLUGIN_DIR . 'templates/channel-archive-post.php'; ?>
    <?php endwhile; ?>

    <div class="mdp-flex mdp-gap5 mdp-pagination">
    <div class="nav-previous mdp-page-button alignleft"><?php previous_posts_link( 'Previous' ); ?></div>
    <div class="nav-next mdp-page-button alignright"><?php next_posts_link( 'Next' ); ?></div>
    </div>

    <?php else : ?>
    <p class="mdp-textcenter">
      <?php 
      $lowertermtitle = strtolower(single_term_title("", false) ?: "");
      echo "Sorry, no " . $lowertermtitle . " matched your criteria."; 
      ?>
    </p>
    <?php endif; ?>
  </div>

</section>

<?php
get_footer();