<?php
add_filter( 'theme_page_templates', 'pluginname_template_as_option', 10, 3 );
function pluginname_template_as_option( $page_templates, $theme, $post ){

    $page_templates['custom-page-template.php'] = 'Full List Countries';
    $page_templates['users-fav-template.php'] = 'User Fav Template';
    $page_templates['log-in-template.php'] = 'Log In Template';
    return $page_templates;

}
add_filter( 'template_include', 'pluginname_load_template', 99 );
function pluginname_load_template( $template ) {

    global $post;

    $log_in   = 'log-in-template.php';
    $fav_template_slug   = 'users-fav-template.php';
    $custom_template_slug   = 'custom-page-template.php';
    $page_template_slug     = get_page_template_slug( $post->ID );

    if( $page_template_slug == $custom_template_slug ){
        return  WP_PLUGIN_DIR. '/bone-kirov-main' .'/templates/'. $custom_template_slug;
    } else if($page_template_slug == $fav_template_slug) {
        return  WP_PLUGIN_DIR. '/bone-kirov-main' .'/templates/'. $fav_template_slug;
    } else if($page_template_slug == $log_in ) {
        return  WP_PLUGIN_DIR. '/bone-kirov-main' .'/templates/'. $log_in;
    }

    return $template;

}
?>
