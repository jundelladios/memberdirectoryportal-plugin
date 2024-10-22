<?php
global $post;
$postapidata = get_post_meta( $post->ID, 'mdp_data', true);
$postapidata = json_decode($postapidata);

$channelId = $postapidata->channel->id;
$postChannels = get_posts(array(
  'numberposts'   => -1,
  'post_type'     => 'mdp_channels',
  'meta_key' => 'mdp_channel_id',
  'meta_value' => $channelId
));
$postchannel = $postChannels[0];
$post_type = 'mdp_channel_' . $postchannel->ID;
$categoryTerm = $post_type . "_category";
$tagTerm = $post_type . "_tag";
?>

<div class="mdp-panel mdp-mb5 mdp-list">
  <?php 
  if($postapidata->event) {
    // event
    echo "event";
  } else if ($postapidata->job) {
    // job
    $job = $postapidata->job;
    ?>
    <div class="mdp-padding">
      <h4 class="mdp-archive-title mdp-title"><?php echo the_title(); ?></h4>
      <p><?php echo $postapidata->caption; ?></p>

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
    </div>
    <?php
  } else if ( $postapidata->advertisement ) {
    // ads
    $ads = $postapidata->advertisement;
    ?>
    <div class="mdp-padding">
      <h4 class="mdp-archive-title mdp-title"><?php echo the_title(); ?></h4>
      <p class="mdp-italic"><?php echo $ads->tagline; ?></p>
      <p><?php echo $postapidata->caption; ?></p>
    </div>
    <?php
  } else {
    // normal post
    ?>
    <div class="mdp-padding">
      <p><?php echo $postapidata->caption; ?></p>
    </div>
    <?php
  }
  ?>

  <div class="mdp-footer mdp-padding ">
    <?php include MDP_PLUGIN_DIR . '/templates/archive/archive-terms.php'; ?>
  </div>
</div>

<?php
//echo the_title();