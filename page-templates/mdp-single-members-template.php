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

<section class="mdp-template-main">

  <div class="mdp-container mdp">

    <div class="mdp-mb5">
      <div class="mdp-panel">
        <div class="mdp-header mdp-padding mbp-border-b0 ">
          <h4 class="mdp-title"><?php echo $member->company_name; ?></h4>
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
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-location-pin"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18l-2 -4l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5l-2.901 8.034" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /></svg>
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
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mail"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
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

</section>

<?php get_footer();
