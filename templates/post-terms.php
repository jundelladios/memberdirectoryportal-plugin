<?php $categories = get_the_terms( $post->ID, $categoryTerm ); ?>
<?php if(isset($categories) && is_array($categories) && count($categories)): ?>
<div class="mdp-mb5">
  <div class="mdp-panel">
    <div class="mdp-header mdp-padding">
      <h4 class="mdp-title mdp-wicon">
        <i class="fa-solid fa-tags"></i>
        Categories
      </h4>
    </div>
    <div class="mdp-padding mdp-tax">
      <?php foreach( $categories as $key => $category ): 
        $categorylink = get_term_link( $category->term_id );
        ?>
        <div class="mdp-padding">
          <a class="mdp-link mdp-wicon" href="<?php echo $categorylink; ?>">
            <i class="fa-solid fa-tags"></i>
            <?php echo $category->name; ?>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>

<?php $tags = get_the_terms( $post->ID, $tagTerm ); ?>
<?php if(isset($tags) && is_array($tags) && count($tags)): ?>
<div class="mdp-mb5">
  <div class="mdp-panel">
    <div class="mdp-header mdp-padding">
      <h4 class="mdp-title mdp-wicon">
        <i class="fa-solid fa-tag"></i>
        Tags
      </h4>
    </div>
    <div class="mdp-padding mdp-tax">
      <?php foreach( $tags as $key => $tag ): 
        $taglink = get_term_link( $tag->term_id );
        ?>
        <div class="mdp-padding">
          <a class="mdp-link mdp-wicon" href="<?php echo $taglink; ?>">
            <i class="fa-solid fa-tag"></i>
            <?php echo $tag->name; ?>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>