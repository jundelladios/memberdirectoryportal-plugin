<?php global $apidata; ?>
<?php if(!empty( $apidata->address1 )): ?>
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
    <p><a class="mdp-link" href="tel:<?php echo $apidata->contact_phone; ?>"><?php echo $apidata->contact_phone; ?></a></p>
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
          <i class="fa-regular fa-envelope"></i>
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