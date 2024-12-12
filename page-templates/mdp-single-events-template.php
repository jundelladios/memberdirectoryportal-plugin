<?php 
/**
 * Template Name: MDP Events Template
 */

global $apidata;
global $post;
$event = $apidata->event;

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
              Date
            </p>
          </div>
          <div>
            <p><?php echo memberdirectoryportal_js_dateformat('F j, Y @ h:i A', $event->start_date); ?></p>
            <p><?php echo memberdirectoryportal_js_dateformat('F j, Y @ h:i A', $event->end_date); ?></p>
            <div class="mdp-mt5">
              <add-to-calendar-button
                name="<?php echo $apidata->title; ?>"
                description="<?php echo wp_strip_all_tags(urldecode($apidata->caption)); ?>"
                startDate="<?php echo memberdirectoryportal_js_dateformat('Y-m-d', $event->start_date); ?>"
                endDate="<?php echo memberdirectoryportal_js_dateformat('Y-m-d', $event->end_date); ?>"
                startTime="<?php echo memberdirectoryportal_js_dateformat('H:i', $event->start_date); ?>"
                endTime="<?php echo memberdirectoryportal_js_dateformat('H:i', $event->end_date); ?>"
                location="<?php echo $locationAddress; ?>"
                options="['Apple','Google','iCal','Microsoft365','Outlook.com','Yahoo']"
                trigger="click"
                inline
                iCalFileName="<?php echo sanitize_title( $apidata->title ); ?>"
              ></add-to-calendar-button>
            </div>
          </div>
        </div>

        <div class="mdp-info mdp-padding">
          <div>
            <p class="mdp-wicon">
              <span class="mdp-iconwrap">
                  <i class="fa-regular fa-square-check"></i>
              </span>
              Description
            </p>
          </div>
          <div>
            <p><?php echo urldecode($event->datetime_description); ?></p>
          </div>
        </div>

        <div class="mdp-info mdp-padding">
          <div>
            <p class="mdp-wicon">
              <span class="mdp-iconwrap">
                  <i class="fa-regular fa-square-check"></i>
              </span>
              Fee Description
            </p>
          </div>
          <div>
            <p><?php echo urldecode($event->fee_description); ?></p>
          </div>
        </div>

      </div>
    </div>

    <?php 
    $apilocation = $apidata;
    require_once MDP_PLUGIN_DIR . 'templates/post-location.php';
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
