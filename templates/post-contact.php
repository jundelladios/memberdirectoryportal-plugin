<?php global $apidata; ?>
<?php if(!empty( $apidata->address1 )): ?>
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
    <p><?php echo $apidata->address1; ?> <?php echo $apidata->city; ?>, <?php echo $apidata->country; ?> <?php echo $apidata->postal_code; ?></p>
  </div>
</div>
<?php endif; ?>


<?php if(!empty( $apidata->contact_phone )): ?>
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
    <p><a class="mdp-link" href="tel:<?php echo $apidata->contact_phone; ?>"><?php echo memberdirectoryportal_phone_format($apidata->contact_phone); ?></a></p>
  </div>
</div>
<?php endif; ?>

<?php if(!empty( $apidata->fax )): ?>
<div class="mdp-info mdp-padding">
  <div>
    <p class="mdp-wicon">
      <span class="mdp-iconwrap">
          <i class="fa-solid fa-phone"></i>
      </span>
      Fax
    </p>
  </div>
  <div>
    <p><a class="mdp-link" href="tel:<?php echo $apidata->fax; ?>"><?php echo $apidata->fax; ?></a></p>
  </div>
</div>
<?php endif; ?>

<?php if(!empty( $apidata->contact_email )): ?>
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
    <p><a class="mdp-link" href="mailto:<?php echo $apidata->contact_email; ?>"><?php echo $apidata->contact_email; ?></a></p>
  </div>
</div>
<?php endif; ?>

<?php if(!empty( $apidata->website )): ?>
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
    <p><a class="mdp-link" target="_blank" href="<?php echo $apidata->website; ?>"><?php echo $apidata->website; ?></a></p>
  </div>
</div>
<?php endif; ?>