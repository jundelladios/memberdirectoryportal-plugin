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
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-tags"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 8v4.172a2 2 0 0 0 .586 1.414l5.71 5.71a2.41 2.41 0 0 0 3.408 0l3.592 -3.592a2.41 2.41 0 0 0 0 -3.408l-5.71 -5.71a2 2 0 0 0 -1.414 -.586h-4.172a2 2 0 0 0 -2 2z" /><path d="M18 19l1.592 -1.592a4.82 4.82 0 0 0 0 -6.816l-4.592 -4.592" /><path d="M7 10h-.01" /></svg>
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
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-tag"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M3 6v5.172a2 2 0 0 0 .586 1.414l7.71 7.71a2.41 2.41 0 0 0 3.408 0l5.592 -5.592a2.41 2.41 0 0 0 0 -3.408l-7.71 -7.71a2 2 0 0 0 -1.414 -.586h-5.172a3 3 0 0 0 -3 3z" /></svg>
          </span>
          <?php echo $tag->name; ?>
        </a>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>