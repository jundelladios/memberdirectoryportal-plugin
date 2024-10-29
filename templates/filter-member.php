<?php 

global $wp;

$categories = get_terms(array(
  'taxonomy' => "mdp_members_category"
));

$tags = get_terms(array(
  'taxonomy' => "mdp_members_tag"
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

      <?php if(count($categories)): ?>
      <div class="mdp-filter-col mdp-filter-category">
        <select class="mdp-input" placeholder="Category" name="categories">
          <option value="">Select Category</option>
          <?php foreach($categories as $category): ?>
            <option value="<?php echo $category->slug; ?>" <?php echo $searchCategory == $category->slug ? "selected": "";  ?>><?php echo $category->name; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <?php endif; ?>

      <?php if(count($tags)): ?>
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
          <i class="fa-solid fa-magnifying-glass"></i>
          Reset Filters
          </a>

        <button type="submit" class="mdp-wicon mdp-button">
          Apply Filters
        </button>
      </div>

    </div>

  </form>
</div>