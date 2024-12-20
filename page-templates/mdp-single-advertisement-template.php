<?php 
/**
 * Template Name: MDP Advertisement Template
 */

global $apidata;
global $post;
$ads = $apidata->advertisement;

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

<section class="mdp-template-main">

  <div class="mdp-container mdp">

    <?php require_once MDP_PLUGIN_DIR . 'templates/post-medias-instagram.php'; ?>

    <div class="mdp-mb5">
      <div class="mdp-panel">
        <div class="mdp-header mdp-padding mbp-border-b0 ">
          <h4 class="mdp-title"><?php echo $apidata->title; ?></h4>
          <p class="mdp-mt5"><?php echo urldecode($apidata->caption); ?></p>
        </div>
      </div>
    </div>


    <div class="mdp-mb5">
      <div class="mdp-panel">
        <div class="mdp-header mdp-padding">
          <h4 class="mdp-title">Details</h4>
        </div>

        <div class="mdp-info mdp-padding">
          <div>
            <p class="mdp-wicon">
              <span class="mdp-iconwrap">
              <i class="fa-regular fa-calendar"></i>
              </span>
              Tagline
            </p>
          </div>
          <div>
            <p class="mdp-italic"><?php echo $ads->tagline; ?></p>
          </div>
        </div>

        <div class="mdp-info mdp-padding">
          <div>
            <p class="mdp-wicon">
              <span class="mdp-iconwrap">
                  <i class="fa-regular fa-address-book"></i>
              </span>
              <?php if($ads->no_expiration): ?>
                Offer started
              <?php else: ?>
                Date offered 
              <?php endif; ?>
            </p>
          </div>
          <div>
            <p><?php echo memberdirectoryportal_js_dateformat('F j, Y @ h:i A', $ads->offer_start); ?></p>
            <?php if(!$ads->no_expiration): ?>
            <p><?php echo memberdirectoryportal_js_dateformat('F j, Y @ h:i A', $ads->offser_end); ?></p>
            <?php endif; ?>
          </div>
        </div>

      </div>
    </div>

    <?php 
    require_once MDP_PLUGIN_DIR . 'templates/post-videos.php';
    ?>


    <div class="mdp-mb5">
      <div class="mdp-panel">
        <div class="mdp-header mdp-padding">
          <h4 class="mdp-title">Contact Information</h4>
        </div>
        <?php 
        require_once MDP_PLUGIN_DIR . 'templates/post-contact.php';
        ?>
      </div>
    </div>

    <?php 
    require_once MDP_PLUGIN_DIR . 'templates/post-terms.php';
    ?>

  </div>

</section>

<?php 

get_footer();