<?php global $apidata; ?>

<?php if(is_array($apidata->medias) && count($apidata->medias)): ?>
  <div class="mdp-instagram-grid">
    <?php 
    $mediaIndex = 0;
    foreach( $apidata->medias as $media ): 
    $mediaalt = preg_replace("/\.[^.]+$/", "", $media->name);
    ?>
      <?php if(str_contains($media->mime, "image")): ?>
        <div class="mdp-instagram-item">
          <img src="<?php echo $media->url; ?>" alt="<?php echo $mediaalt; ?>" title="<?php echo $mediaalt; ?>" width="<?php echo $media->width; ?>" height="<?php echo $media->height; ?>">
        </div>
      <?php endif; ?>
      <?php if(str_contains($media->mime, "video")): ?>
        <div class="mdp-instagram-item">
          <video width="100%" height="500" class="mdp_vid" controls>
            <source src="<?php echo $media->url; ?>" type="<?php echo $media->mime; ?>">
            Your browser does not support the video tag.
          </video>
        </div>
      <?php endif; ?>
    <?php 
    $mediaIndex++;
    endforeach; ?>
  </div>
<?php endif; ?>