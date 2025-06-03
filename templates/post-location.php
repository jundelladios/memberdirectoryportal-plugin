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
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-location-pin"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18l-2 -4l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5l-2.901 8.034" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /></svg>
          </span>
          Address
        </p>
      </div>
      <div>
        <p>
          <a href="http://maps.google.com/?q=<?php echo $locationAddress; ?>" class="mdp-link" target="_blank"><?php echo $locationAddress; ?></a>
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