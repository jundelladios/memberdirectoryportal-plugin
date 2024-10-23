<?php 
global $apilocation;
if( (isset( $apilocation->lat ) && isset( $apilocation->lng )) && (!empty( $apilocation->lat ) && !empty( $apilocation->lng )) ): ?>
<div class="mdp-mb5">
  <div class="mdp-panel">
    <div class="mdp-header mdp-padding">
      <h4 class="mdp-title">Location</h4>
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
        <p>
          <a href="http://www.google.com/maps?daddr=<?php echo $apilocation->lat; ?>,<?php echo $apilocation->lng; ?>" class="mdp-link" target="_blank"><?php echo $locationAddress; ?></a>
        </p>
      </div>
    </div>

    <div>
      <iframe src="<?php echo memberdirectoryportal_get_portaldomain() . "/embeds/$mapslug/" . $apilocation->id; ?>" style="width:100%;height:400px;border:0;" width="100%" height="400px">
      </iframe>
    </div>
  </div>
</div>
<?php endif; ?>