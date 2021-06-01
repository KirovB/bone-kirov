<?php
if ( ! function_exists( 'create_posttype' ) ) {
  function create_posttype() {

    register_post_type('countries', array(
    'supports' =>array('title',),
    'show_in_rest' => true,
    'public' => true,
    'rewrite' => array('slug'=> 'country'),
    'has_archive' => false,
    'publicly_queryable' => false,
    'labels' => array('name' => 'Countries',
    'add_new_item' =>"Add New Country",
    'edit_item' => 'Edit Country',
    'all_items' => 'All Conuntries',
    'singular_name' => 'Country'),
    'menu_icon' => 'dashicons-location-alt',
    ));

    register_post_type('favourite', array(
      'supports' => array('title'),
      'public' => false,
      'show_ui' => false,
      'labels' => array(
        'name' => 'Favourite',
        'add_new_item' => 'Add New favourite',
        'edit_item' => 'Edit favourite',
        'all_items' => 'All favourite',
        'singular_name' => 'favourite'
      ),
      'menu_icon' => 'dashicons-heart'
    ));

  }
}

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_60b23125bbc7c',
	'title' => 'Country Fields',
	'fields' => array(
		array(
			'key' => 'field_60b23136c61db',
			'label' => 'Region',
			'name' => 'region',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_60b2313dc61dc',
			'label' => 'Population',
			'name' => 'population',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'countries',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_60b2c65f8746d',
	'title' => 'Favorites',
	'fields' => array(
		array(
			'key' => 'field_60b2c664b8a61',
			'label' => 'Favorite Id',
			'name' => 'favorite_id',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'favourite',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;


add_action( 'init', 'create_posttype' );
