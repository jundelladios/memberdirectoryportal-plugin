<?php 

global $wp;

$categories = get_terms(array(
  'taxonomy' => $atts['post_type'] . "_category",
  'hide_empty' => false
));

$tags = get_terms(array(
  'taxonomy' => $atts['post_type'] . "_tag",
  'hide_empty' => false
));

$searchCategory = get_query_var("categories");
$searchTag = get_query_var("tags");
$search = get_query_var("search");

$address = get_query_var("address");
$city = get_query_var("city");
$state = get_query_var("state");
$country = get_query_var("country");
$zip = get_query_var("zip");

$phone = get_query_var("phone");
$email = get_query_var("email");
$fax = get_query_var("fax");
$website = get_query_var("website");

?>

<div class="mdp-container mdp">
  <form action="<?php echo $atts['redirect'] ?>">
    <div class="mdp-filter-wrap mdp-panel mdp-padding">

      <div class="mdp-filter-col mdp-filter-search">
        <input class="mdp-input" value="<?php echo $search; ?>" type="text" name="search" placeholder="What are you looking for?">
      </div>

      <?php if(is_array($categories) && count($categories)): ?>
      <div class="mdp-filter-col mdp-filter-category">
        <select class="mdp-input" placeholder="Category" name="categories">
          <option value="">Select Category</option>
          <?php foreach($categories as $category): ?>
            <option value="<?php echo $category->slug; ?>" <?php echo $searchCategory == $category->slug ? "selected": "";  ?>><?php echo $category->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <?php endif; ?>

      <?php if(is_array($tags) && count($tags)): ?>
      <div class="mdp-filter-col mdp-filter-tag">
        <select class="mdp-input" placeholder="Tags" name="tags" >
          <option value="">Select Tag</option>
          <?php foreach($tags as $tag): ?>
            <option value="<?php echo $tag->slug; ?>" <?php echo $searchTag == $tag->slug ? "selected": "";  ?>><?php echo $tag->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <?php endif; ?>
      
      <div class="mdp-filter-col mdp-textright mdp-flex mdp-justify-end mdp-gap5">
        <button type="button" class="mdp-more-button mdp-wicon mdp-link">
          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-filter"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" /></svg>
          More Filters
        </button>
        <button type="submit" class="mdp-wicon mdp-button">
          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
          Search Listing
        </button>
      </div>
    </div>

    <div class="mdp-more-filter mdp-panel mdp-padding mdp-mt5">

      <div class="mdp-mb5">
        <input value="<?php echo $address; ?>" class="mdp-input bordered" type="text" name="address" placeholder="Enter address">
      </div>

      <div class="mdp-mb5">
        <div class="mdp-filter-wrap">
          <div class="mdp-filter-col">
            <input value="<?php echo $city; ?>" class="mdp-input bordered" type="text" name="city" placeholder="City">
          </div>
          <div class="mdp-filter-col">
            <input value="<?php echo $state; ?>" class="mdp-input bordered" type="text" name="state" placeholder="State">
          </div>
        </div>
      </div>

      <div class="mdp-mb5">
        <div class="mdp-filter-wrap">
          <div class="mdp-filter-col">
            <input value="<?php echo $country; ?>" class="mdp-input bordered" type="text" name="country" placeholder="Country">
          </div>
          <div class="mdp-filter-col">
            <input value="<?php echo $zip; ?>" class="mdp-input bordered" type="text" name="zip" placeholder="Zipcode">
          </div>
        </div>
      </div>


      <div class="mdp-mb5">
        <div class="mdp-filter-wrap">
          <div class="mdp-filter-col">
            <input value="<?php echo $email; ?>" class="mdp-input bordered" type="text" name="email" placeholder="Email">
          </div>
          <div class="mdp-filter-col">
            <input value="<?php echo $phone; ?>" class="mdp-input bordered" type="text" name="phone" placeholder="Phone">
          </div>
        </div>
      </div>

      <div class="mdp-mb5">
        <input value="<?php echo $website; ?>" class="mdp-input bordered" type="text" name="website" placeholder="Website">
      </div>

      <div class="mdp-flex mdp-justify-end mdp-gap5">
        <a href="<?php echo $atts['redirect']; ?>" class="mdp-wicon mdp-button secondary mdp-link">
          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
          Reset Filters
          </a>

        <button type="submit" class="mdp-wicon mdp-button">
          Apply Filters
        </button>
      </div>

    </div>

  </form>
</div>