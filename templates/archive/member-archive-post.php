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
              <i class="fa-regular fa-address-book"></i>
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
              <i class="fa-regular fa-envelope"></i>
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
    <?php include MDP_PLUGIN_DIR . '/templates/archive/archive-terms.php'; ?>
  </div>
  
</div>