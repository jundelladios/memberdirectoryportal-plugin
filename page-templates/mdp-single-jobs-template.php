<?php 
/**
 * Template Name: MDP Jobs Template
 */

global $apidata;
global $post;
$job = $apidata->job;

$posts = get_posts(array(
  'post_type'     => 'mdp_channels',
  'meta_key' => 'mdp_channel_id',
  'meta_value' => $apidata->channel->id
));

$channelPost = $posts[0];
$posttype = 'mdp_channel_' . $channelPost->ID;
$categoryTerm = $posttype."_category";
$tagTerm = $posttype."_tag";
$locationAddress = $apidata->address1 . " " . $apidata->city . ", " . $apidata->country . " " . $apidata->postal_code;
$mapslug = "post-map";
get_header(); 
?>

<section class="mdp-template-main">

  <div class="mdp-container mdp">

    <?php require_once MDP_PLUGIN_DIR . 'templates/post-medias.php'; ?>

    <div class="mdp-mb5">
      <div class="mdp-panel">
        <div class="mdp-header mdp-padding mbp-border-b0 ">
          <h4 class="mdp-title"><?php echo $apidata->title; ?></h4>
          <p class="mdp-mt5"><?php echo urldecode($apidata->caption); ?></p>
        </div>
      </div>
    </div>

    <?php 
    require_once MDP_PLUGIN_DIR . 'templates/post-videos.php';
    ?>

    <?php 
    require_once MDP_PLUGIN_DIR . 'templates/post-terms.php';
    ?>

    <div class="mdp-mb5">
      <div class="mdp-panel">
        <div class="mdp-header mdp-padding">
          <h4 class="mdp-title">Contact Information</h4>
        </div>

        <?php if(!empty( $job->business_name )): ?>
        <div class="mdp-info mdp-padding">
          <div>
            <p class="mdp-wicon">
              <span class="mdp-iconwrap">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-phone"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
              </span>
              Business name
            </p>
          </div>
          <div>
            <p><?php echo $job->business_name; ?></p>
          </div>
        </div>
        <?php endif; ?>


        <?php if(!empty( $job->contact_rep )): ?>
        <div class="mdp-info mdp-padding">
          <div>
            <p class="mdp-wicon">
              <span class="mdp-iconwrap">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-phone"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
              </span>
              Contact Rep
            </p>
          </div>
          <div>
            <p><?php echo $job->contact_rep; ?></p>
          </div>
        </div>
        <?php endif; ?>

        <?php 
        require_once MDP_PLUGIN_DIR . 'templates/post-contact.php';
        ?>
        
        
      </div>
    </div>
    
    <?php 
    $apilocation = $apidata;
    require_once MDP_PLUGIN_DIR . 'templates/post-location.php';
    ?>

  </div>

</section>

<?php get_footer();
