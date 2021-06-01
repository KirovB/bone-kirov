<?php

add_action('rest_api_init', 'boneFavouriteRoutes');

function boneFavouriteRoutes() {
  register_rest_route('bone/v1', 'manageFav', array(
    'methods' => 'POST',
    'callback' => 'createFavourite'
  ));

  register_rest_route('bone/v1', 'manageFav', array(
    'methods' => 'DELETE',
    'callback' => 'deleteFavourite'
  ));


}

function createFavourite($data) {
  if (is_user_logged_in()) {
    $country = sanitize_text_field($data['countryId']);
    $existQuery = new WP_Query(array(
      'author' => get_current_user_id(),
      'post_type' => 'favourite',
      'meta_query' => array(
        array(
          'key' => 'favorite_id',
          'compare' => '=',
          'value' => $country
        )
      )
    ));

    if ($existQuery->found_posts == 0 AND get_post_type($country) == 'countries') {
      return wp_insert_post(array(
        'post_type' => 'favourite',
        'post_status' => 'publish',
        'post_title' =>  get_current_user_id(),
        'meta_input' => array(
        'favorite_id' => $country
        )
      ));
    } else {
      die("Error.");
    }


  } else {
    die("Only logged in users can save a favourite.");
  }


}

function deleteFavourite($data) {
  $favId = sanitize_text_field($data['fav']);
  if (get_current_user_id() == get_post_field('post_author', $favId) AND get_post_type($favId) == 'favourite') {
    wp_delete_post($favId, true);
    return 'Fav deleted.';
  } else {
    die("Error.");
  }
}
