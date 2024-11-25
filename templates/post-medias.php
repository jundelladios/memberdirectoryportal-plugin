<?php if(isset($apidata->medias) && is_array($apidata->medias) && count($apidata->medias)): ?>
  <div class="mdp_medias_wrap">

    <div class="mdp-mb5 mdp_medias">
      <?php 
      $mediaIndex = 0;
      foreach( $apidata->medias as $media ): 
      $mediaalt = preg_replace("/\.[^.]+$/", "", $media->name);
      ?>
        <?php if(str_contains($media->mime, "image")): ?>
          <div>
            <img src="<?php echo $media->url; ?>" alt="<?php echo $mediaalt; ?>" title="<?php echo $mediaalt; ?>" width="<?php echo $media->width; ?>" height="<?php echo $media->height; ?>">
          </div>
        <?php endif; ?>
        <?php if(str_contains($media->mime, "video")): ?>
          <div>
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

    <?php if( count($apidata->medias) > 1 ): ?>
    <button class="mdpmediabtn mdpprev">
      <i class="fa-solid fa-angle-left"></i>
    </button>
    <button class="mdpmediabtn mdpnext">
      <i class="fa-solid fa-chevron-right"></i>
    </button>
    <?php endif; ?>
  </div>
<?php endif; ?>