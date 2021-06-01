<?php


global $wpdb, $user_ID;
if ($user_ID) {

  wp_redirect( home_url() ); exit;

}else{
get_header();
   echo '<div class="container">';
      echo '<div class="col-md-12">';
        wp_login_form(

          array(
            'echo'           => true,
            'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
            'form_id'        => 'loginform',
            'label_username' => __( 'Your Username' ),
            'label_password' => __( 'Your Password' ),
            'label_remember' => __( 'Remember Me' ),
            'label_log_in'   => __( 'Log In' ),
            'id_username'    => 'user_login',
            'id_password'    => 'user_pass',
            'id_remember'    => 'rememberme',
            'id_submit'      => 'wp-submit',
            'remember'       => true,
            'value_username' => '',
          )
        );
    echo '</div>';
 echo '</div>';
   get_footer();
   }



?>
