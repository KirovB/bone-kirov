<?php
add_action( 'wp_ajax_import_countries', 'import_countries' );
add_action( 'wp_ajax_nopriv_import_countries', 'import_countries' );

function import_countries() {

 $developer_data = json_decode( file_get_contents( 'https://restcountries.eu/rest/v2/all?fields=name;region;population' ) );
 insert_or_update( $developer_data );
  wp_die();

}


function insert_or_update($developer_data) {
  if ($developer_data) {
   foreach ($developer_data as $country) {
      $title = $country->name;
      $existing_country = get_page_by_title( $title, 'OBJECT', 'countries' );
      if(   $existing_country === null  ){

      $my_post = array(
           'post_title'    =>  $title,
           'post_status'   => 'publish',
           'post_type'   => 'countries',

      );
      $post_id = wp_insert_post( $my_post, true );
      $fillable = [
        'field_60b23136c61db' => 'region',
        'field_60b2313dc61dc' => 'population',

     ];
     foreach( $fillable as $key => $name ) {
       update_field( $key, $country->$name, $post_id);
     }
    }
   }
  }
}






?>
