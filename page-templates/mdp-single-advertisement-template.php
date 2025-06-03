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
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-week"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M7 14h.013" /><path d="M10.01 14h.005" /><path d="M13.01 14h.005" /><path d="M16.015 14h.005" /><path d="M13.015 17h.005" /><path d="M7.01 17h.005" /><path d="M10.01 17h.005" /></svg>
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
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-calendar"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 2a1 1 0 0 1 .993 .883l.007 .117v1h1a3 3 0 0 1 2.995 2.824l.005 .176v12a3 3 0 0 1 -2.824 2.995l-.176 .005h-12a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-12a3 3 0 0 1 2.824 -2.995l.176 -.005h1v-1a1 1 0 0 1 1.993 -.117l.007 .117v1h6v-1a1 1 0 0 1 1 -1zm3 7h-14v9.625c0 .705 .386 1.286 .883 1.366l.117 .009h12c.513 0 .936 -.53 .993 -1.215l.007 -.16v-9.625z" /><path d="M12 12a1 1 0 0 1 .993 .883l.007 .117v3a1 1 0 0 1 -1.993 .117l-.007 -.117v-2a1 1 0 0 1 -.117 -1.993l.117 -.007h1z" /></svg>
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