<?php
global $post;
$postapidata = get_post_meta( $post->ID, 'mdp_data', true);
$postapidata = json_decode($postapidata);
$member = $postapidata->user;
$locationAddress = $member->address1 . " " . $member->city . ", " . $member->country . " " . $member->postal_code;
$categoryTerm = "mdp_members_category";
$tagTerm = "mdp_members_tag";
?>

<div class="mdp-panel mdp-mb5 mdp-list">
  <div class="mdp-padding">
    <a href="<?php echo get_permalink( $post ); ?>" class="mdp-link mdp-link-title">
      <h4 class="mdp-archive-title mdp-title"><?php echo the_title(); ?></h4>
    </a>
    <div class="mdp-info mdp-padding mdp-py0">
      <div>
        <p class="mdp-wicon">
          <span class="mdp-iconwrap">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-location-pin"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18l-2 -4l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5l-2.901 8.034" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /></svg>
          </span>
          Address
        </p>
      </div>
      <div>
        <p><?php echo $locationAddress; ?></p>
      </div>
    </div>


    <div class="mdp-info mdp-padding mdp-py0">
      <div>
        <p class="mdp-wicon">
          <span class="mdp-iconwrap">
              <i class="fa-solid fa-phone"></i>
          </span>
          Phone
        </p>
      </div>
      <div>
        <p><a class="mdp-link" href="tel:<?php echo $member->phone; ?>"><?php echo $member->phone; ?></a></p>
      </div>
    </div>

    <div class="mdp-info mdp-padding mdp-py0">
      <div>
        <p class="mdp-wicon">
          <span class="mdp-iconwrap">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mail"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
          </span>
          Email
        </p>
      </div>
      <div>
        <p><a class="mdp-link" href="mailto:<?php echo $member->email; ?>"><?php echo $member->email; ?></a></p>
      </div>
    </div>

    <div class="mdp-info mdp-padding mdp-py0">
      <div>
        <p class="mdp-wicon">
          <span class="mdp-iconwrap">
              <i class="fa-solid fa-link"></i>
          </span>
          Website
        </p>
      </div>
      <div>
        <p><a class="mdp-link" target="_blank" href="<?php echo $member->website; ?>"><?php echo $member->website; ?></a></p>
      </div>
    </div>
  </div>

  <div class="mdp-footer mdp-padding ">
    <?php include MDP_PLUGIN_DIR . 'templates/archive-terms.php'; ?>
  </div>
  
</div>