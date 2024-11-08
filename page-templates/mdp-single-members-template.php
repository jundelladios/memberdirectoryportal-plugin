<?php 
/**
 * Template Name: MDP Members Template
 */

global $apidata;
global $post;
$member = $apidata->user;
$categoryTerm = "mdp_members_category";
$tagTerm = "mdp_members_tag";
$locationAddress = $member->address1 . " " . $member->city . ", " . $member->country . " " . $member->postal_code;
$mapslug = "member-map";
get_header(); 
?>

<div class="mdp-container mdp">

  <div class="mdp-mb5">
    <div class="mdp-panel">
      <div class="mdp-header mdp-padding mbp-border-b0 ">
        <h4 class="mdp-title"><?php echo $member->company; ?></h4>
      </div>
    </div>
  </div>

  <?php 
  require_once MDP_PLUGIN_DIR . 'templates/post-terms.php';
  ?>

  <div class="mdp-mb5">
    <div class="mdp-panel">
      <div class="mdp-header mdp-padding">
        <h4 class="mdp-title">Contact Information</h4>
      </div>

      <div class="mdp-info mdp-padding">
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


      <div class="mdp-info mdp-padding">
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

      <div class="mdp-info mdp-padding">
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

      <div class="mdp-info mdp-padding">
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
      
      <?php 
      
      if( isset( $member->SocialMedia ) ): 
        $socials = $member->SocialMedia;
        $socialLists = array(
          !empty( $socials->facebook ),
          !empty( $socials->instagram ),
          !empty( $socials->twitter ),
          !empty( $socials->youtube ),
          !empty( $socials->linkedIn ),
        );

        $hasSocial = array_filter($socialLists, function($val) { return $val; });
        if(count($hasSocial)):
      ?>
      <div class="mdp-info mdp-padding">
        <div>
          <p class="mdp-wicon">
            <span class="mdp-iconwrap">
              <i class="fa-solid fa-share"></i>
            </span>
            Social
          </p>
        </div>
        <div class="mdp-flex mdp-items-center mdp-gap10">

          <?php if( !empty( $socials->facebook ) ): ?>
            <a href="<?php echo $socials->facebook; ?>" target="_blank" class="mdp-socialbtn">
              <i class="fa-brands fa-facebook"></i>
            </a>
          <?php endif; ?>

          <?php if( !empty( $socials->instagram ) ): ?>
            <a href="<?php echo $socials->instagram; ?>" target="_blank" class="mdp-socialbtn">
              <i class="fa-brands fa-instagram"></i>
            </a>
          <?php endif; ?>

          <?php if( !empty( $socials->twitter ) ): ?>
            <a href="<?php echo $socials->twitter; ?>" target="_blank" class="mdp-socialbtn">
              <i class="fa-brands fa-twitter"></i>
            </a>
          <?php endif; ?>

          <?php if( !empty( $socials->youtube ) ): ?>
            <a href="<?php echo $socials->youtube; ?>" target="_blank" class="mdp-socialbtn">
              <i class="fa-brands fa-youtube"></i>
            </a>
          <?php endif; ?>

          <?php if( !empty( $socials->linkedIn ) ): ?>
            <a href="<?php echo $socials->linkedIn; ?>" target="_blank" class="mdp-socialbtn">
              <i class="fa-brands fa-linkedin"></i>
            </a>
          <?php endif; ?>

        </div>
      </div>
      <?php endif; ?>
      <?php endif; ?>
      
    </div>
  </div>
  
  <?php 
  $apilocation = $member;
  require_once MDP_PLUGIN_DIR . 'templates/post-location.php';
  ?>

</div>

<?php get_footer();
