<?php global $apidata; ?>
<?php if(isset($apidata->videoLinks) && count($apidata->videoLinks)): 
  $mdpvidtitle = $apidata->title ? $apidata->title : wp_trim_words( wp_strip_all_tags(urldecode($apidata->caption), 5, "" ));
  ?>
<div class="mdp-mb5">
  <div class="mdp-panel">
    <div class="mdp-header mdp-padding">
      <h4 class="mdp-title mdp-wicon">
        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-player-play"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 4v16l13 -8z" /></svg>
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