<?php 

global $wp;

$categories = get_terms(array(
  'taxonomy' => $atts['post_type'] . "_category"
));

$tags = get_terms(array(
  'taxonomy' => $atts['post_type'] . "_tag"
));

$categories = get_query_var("categories");
$tags = get_query_var("tags");
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

      <?php if(count($categories)): ?>
      <div class="mdp-filter-col mdp-filter-category">
        <select value="<?php echo $categories; ?>" class="mdp-input" placeholder="Category" name="categories" >
          <?php foreach($categories as $category): ?>
            <option value="<?php echo $category->slug; ?>" <?php echo $categories == $category->name ? "selected": "";  ?>><?php echo $category->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <?php endif; ?>

      <?php if(count($tags)): ?>
      <div class="mdp-filter-col mdp-filter-tag">
        <select value="<?php echo $tags; ?>" class="mdp-input" placeholder="Tags" name="tags" >
          <?php foreach($tags as $tag): ?>
            <option value="<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <?php endif; ?>
      
      <div class="mdp-filter-col mdp-textright mdp-flex mdp-justify-end mdp-gap5">
        <button type="button" class="mdp-more-button mdp-wicon mdp-link">
          <i class="fa-solid fa-filter"></i>
          More Filters
        </button>
        <button type="submit" class="mdp-wicon mdp-button">
          <i class="fa-solid fa-magnifying-glass"></i>
          Search Listing
        </button>
      </div>
    </div>

    <div class="mdp-more-filter mdp-panel mdp-padding mdp-mt5">

      <div class="mdp-mb5">
        <input class="mdp-input bordered" type="text" name="address" placeholder="Enter address">
      </div>

      <div class="mdp-mb5">
        <div class="mdp-filter-wrap">
          <div class="mdp-filter-col">
            <input class="mdp-input bordered" type="text" name="city" placeholder="City">
          </div>
          <div class="mdp-filter-col">
            <input class="mdp-input bordered" type="text" name="state" placeholder="State">
          </div>
        </div>
      </div>

      <div class="mdp-mb5">
        <div class="mdp-filter-wrap">
          <div class="mdp-filter-col">
            <input class="mdp-input bordered" type="text" name="country" placeholder="Country">
          </div>
          <div class="mdp-filter-col">
            <input class="mdp-input bordered" type="text" name="zip" placeholder="Zipcode">
          </div>
        </div>
      </div>


      <div class="mdp-mb5">
        <div class="mdp-filter-wrap">
          <div class="mdp-filter-col">
            <input class="mdp-input bordered" type="text" name="email" placeholder="Email">
          </div>
          <div class="mdp-filter-col">
            <input class="mdp-input bordered" type="text" name="phone" placeholder="Phone">
          </div>
        </div>
      </div>

      <div class="mdp-mb5">
        <input class="mdp-input bordered" type="text" name="website" placeholder="Website">
      </div>

      <div class="mdp-flex mdp-justify-end mdp-gap5">
        <button type="submit" class="mdp-wicon mdp-button secondary">
          <i class="fa-solid fa-magnifying-glass"></i>
          Reset Filters
        </button>

        <button type="submit" class="mdp-wicon mdp-button">
          Apply Filters
        </button>
      </div>

    </div>

  </form>
</div>