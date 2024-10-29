<?php

function mdp_query_vars_filter( $vars ){
  $mdpvars = array(
    "categories",
    "tags",
    "search",
    "address",
    "city",
    "state",
    "zip",
    "phone",
    "email",
    "website"
  );
  foreach($mdpvars as $mdp) {
    $vars[] = $mdp;
  }
  return $vars;
}
add_filter( 'query_vars', 'mdp_query_vars_filter' );