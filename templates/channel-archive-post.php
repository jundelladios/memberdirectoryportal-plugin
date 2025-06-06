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
$locationAddress = $postapidata->address1 . " " . $postapidata->city . ", " . $postapidata->country . " " . $postapidata->postal_code;
?>

<div class="mdp-panel mdp-mb5 mdp-list">
  <?php 
  if($postapidata->event) {
    // event
    $event = $postapidata->event;
    ?>
    <div class="mdp-padding mdp-event-archive-list">
      <div class="mdp-eventarchive-date mdp-padding">
        <p class="mdp-event-date"><?php echo memberdirectoryportal_js_dateformat('j', $event->start_date); ?></p>
        <p class="mdp-event-month"><?php echo memberdirectoryportal_js_dateformat('F', $event->start_date); ?></p>
        <p class="mdp-event-year"><?php echo memberdirectoryportal_js_dateformat('Y', $event->start_date); ?></p>
      </div>
      <div class="mdp-eventarchive-description">
        <a href="<?php echo get_permalink( $post ); ?>" class="mdp-link mdp-link-title">
          <h4 class="mdp-archive-title mdp-title"><?php echo the_title(); ?></h4>
        </a>
        <p><?php echo memberdirectoryportal_exerpt(urldecode($postapidata->caption)); ?></p>
      </div>
      <div class="mdp-eventarchive-location">
        <p>
          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-location"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
          <?php 
          echo $postapidata->address1 . " " . $postapidata->city . ", " . $postapidata->country . " " . $postapidata->postal_code;
          ?>
        </p>
        <p>
          <a href="http://www.google.com/maps?daddr=<?php echo $postapidata->lat; ?>,<?php echo $postapidata->lng; ?>" class="mdp-link mdp-wicon" target="_blank">
          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-map"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7l6 -3l6 3l6 -3v13l-6 3l-6 -3l-6 3v-13" /><path d="M9 4v13" /><path d="M15 7v13" /></svg> Google Map
          </a>
        </p>

        <p class="mdp-mt5">
          <add-to-calendar-button
            name="<?php echo $postapidata->title; ?>"
            description="<?php echo wp_strip_all_tags(urldecode($postapidata->caption)); ?>"
            startDate="<?php echo memberdirectoryportal_js_dateformat('Y-m-d', $event->start_date); ?>"
            endDate="<?php echo memberdirectoryportal_js_dateformat('Y-m-d', $event->end_date); ?>"
            startTime="<?php echo memberdirectoryportal_js_dateformat('H:i', $event->start_date); ?>"
            endTime="<?php echo memberdirectoryportal_js_dateformat('H:i', $event->end_date); ?>"
            location="<?php echo $locationAddress; ?>"
            options="['Apple','Google','iCal','Microsoft365','Outlook.com','Yahoo']"
            trigger="click"
            inline
            iCalFileName="<?php echo sanitize_title( $postapidata->title ); ?>"
          ></add-to-calendar-button>
        </p>
      </div>
    </div>

    <?php
  } else if ($postapidata->job) {
    // job
    $job = $postapidata->job;
    ?>
    <div class="mdp-padding">
      <a href="<?php echo get_permalink( $post ); ?>" class="mdp-link mdp-link-title">
        <h4 class="mdp-archive-title mdp-title"><?php echo the_title(); ?></h4>
      </a>
      <p><?php echo urldecode($postapidata->caption); ?></p>

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
    </div>
    <?php
  } else if ( $postapidata->advertisement ) {
    // ads
    $ads = $postapidata->advertisement;
    ?>
    <div class="mdp-padding">
      <a href="<?php echo get_permalink( $post ); ?>" class="mdp-link mdp-link-title">
        <h4 class="mdp-archive-title mdp-title"><?php echo the_title(); ?></h4>
      </a>
      <p class="mdp-italic"><?php echo $ads->tagline; ?></p>
      <p><?php echo urldecode($postapidata->caption); ?></p>
    </div>
    <?php
  } else {
    // normal post
    ?>
    <div class="mdp-padding">
      <p><?php echo memberdirectoryportal_exerpt(urldecode($postapidata->caption), "Continue to this post &#xbb;", 60); ?></p>
    </div>
    <?php
  }
  ?>

  <div class="mdp-footer mdp-padding ">
    <?php include MDP_PLUGIN_DIR . 'templates/archive-terms.php'; ?>
  </div>
</div>

<?php