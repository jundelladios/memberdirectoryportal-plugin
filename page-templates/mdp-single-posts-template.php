<?php 
/**
 * Template Name: MDP Posts Template
 */

global $apidata;
global $post;
$posts = get_posts(array(
  'post_type'     => 'mdp_channels',
  'meta_key' => 'mdp_channel_id',
  'meta_value' => $apidata->channel->id
));
$channelPost = $posts[0];
$posttype = 'mdp_channel_' . $channelPost->ID;
$categoryTerm = $posttype."_category";
$tagTerm = $posttype."_tag";
get_header(); 
?>

<div class="mdp-container mdp">

  <?php require_once MDP_PLUGIN_DIR . 'templates/post-medias.php'; ?>

  <div class="mdp-mb5">
    <div class="mdp-panel">
      <div class="mdp-header mdp-padding mbp-border-b0 ">
        <p class="mdp-mt5"><?php echo $apidata->caption; ?></p>
      </div>
    </div>
  </div>

  <?php 
  require_once MDP_PLUGIN_DIR . 'templates/post-videos.php';
  ?>

  <?php 
  require_once MDP_PLUGIN_DIR . 'templates/post-terms.php';
  ?>

</div>

<?php get_footer();
