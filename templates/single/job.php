<?php 
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
wp_head(); 
?>

<div class="mdp-container mdp">

  <?php require_once MDP_PLUGIN_DIR . '/templates/post-medias.php'; ?>

  <div class="mdp-mb5">
    <div class="mdp-panel">
      <div class="mdp-header mdp-padding mbp-border-b0 ">
        <h4 class="mdp-title"><?php echo $apidata->title; ?></h4>
        <p class="mdp-mt5"><?php echo $apidata->caption; ?></p>
      </div>
    </div>
  </div>

  <?php 
  require_once MDP_PLUGIN_DIR . '/templates/post-videos.php';
  ?>

  <?php 
  require_once MDP_PLUGIN_DIR . '/templates/post-terms.php';
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
                <i class="fa-solid fa-phone"></i>
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
                <i class="fa-solid fa-phone"></i>
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
      require_once MDP_PLUGIN_DIR . '/templates/post-contact.php';
      ?>
      
      
    </div>
  </div>
  
  <?php 
  $apilocation = $apidata;
  require_once MDP_PLUGIN_DIR . '/templates/post-location.php';
  ?>

</div>

<?php wp_footer(); ?>
