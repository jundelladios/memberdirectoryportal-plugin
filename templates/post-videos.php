<?php global $apidata; ?>
<?php if(isset($apidata->videoLinks) && count($apidata->videoLinks)): 
  $mdpvidtitle = $apidata->title ? $apidata->title : wp_trim_words( $apidata->caption, 5, "" );
  ?>
<div class="mdp-mb5">
  <div class="mdp-panel">
    <div class="mdp-header mdp-padding">
      <h4 class="mdp-title mdp-wicon">
        <i class="fa-solid fa-play"></i>
        Videos
      </h4>
    </div>
    <div class="mdp-padding mdp-tax">
      <?php foreach( $apidata->videoLinks as $key => $video ): 
        $videoURL = $video;
        $vidindex = 0;
        if(str_contains($videoURL, 'youtube')) {
          $vvid = explode("?v=", $videoURL);
          if(count($vvid)>0) {
            $videoURL = "http://www.youtube.com/embed/" . $vvid[1];
          }
        }
        ?>
        <div class="mdp-padding">
          <iframe 
          width="100%" 
          height="300" 
          src="<?php echo $videoURL; ?>" 
          title="<?php echo $mdpvidtitle; ?> <?php echo $vidindex; ?>" 
          frameborder="0" 
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
          referrerpolicy="strict-origin-when-cross-origin" 
          allowfullscreen></iframe>
        </div>
      <?php 
      $vidindex++;
      endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>