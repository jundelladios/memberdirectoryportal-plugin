<div>
  <?php $categories = get_the_terms( $post->ID, $categoryTerm ); ?>
  <?php if(isset($categories) && is_array($categories) && count($categories)): ?>
    <p class="mdp-bold">Categories</p>
  <div class="mdp-flex mdp-gap10 mdp-items-center mdp-mb3 mdp-flexwrap">
    <?php foreach( $categories as $key => $category ): 
      $categorylink = get_term_link( $category->term_id );
      ?>
        <a class="mdp-link mdp-wicon mdp-textsm mdp-flex mdp-items-center mdp-gap5" href="<?php echo $categorylink; ?>">
          <span class="mdp-iconwrap">
            <i class="fa-solid fa-tags"></i>
          </span>
          <?php echo $category->name; ?>
        </a>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>


<div>
  <?php $tags = get_the_terms( $post->ID, $tagTerm ); ?>
  <?php if(isset($tags) && is_array($tags) && count($tags)): ?>
    <p class="mdp-bold">Tags</p>
  <div class="mdp-flex mdp-gap10 mdp-items-center mdp-mb3 mdp-flexwrap">
    <?php foreach( $tags as $key => $tag ): 
      $tagLink = get_term_link( $tag->term_id );
      ?>
        <a class="mdp-link mdp-wicon mdp-textsm mdp-flex mdp-items-center mdp-gap5" href="<?php echo $tagLink; ?>">
          <span class="mdp-iconwrap">
            <i class="fa-solid fa-tag"></i>
          </span>
          <?php echo $tag->name; ?>
        </a>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>