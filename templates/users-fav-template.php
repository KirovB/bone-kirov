<?php
  get_header();



  global $wpdb,$post;
  $post_ids = $wpdb->get_col( "SELECT DISTINCT post_id FROM {$wpdb->prefix}wp_posts WHERE user_id = {$author->ID}" );
    $items = array();
      $query_ids = $wpdb->get_results("SELECT ID FROM ".$wpdb->prefix."posts WHERE (post_type = 'favourite')");
      foreach ($query_ids as $query_id) {
        $query = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$query_id->ID." AND meta_key = 'favorite_id'");
        foreach ($query as $value) {
         $items[] = $value->meta_value;
        }
      }

    $conuntries = new WP_Query(array(
      'posts_per_page' => -1,
      'post_type' => 'countries',
      'orderby' => 'title',
      'order' => 'ASC',
      'post__in' => $items,
    ));

?>

  <section id="countries-list" class="container">
    <div class="col-md-12">
      <?php if (is_user_logged_in() AND ($items) ) { ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th><?php	_e( 'Name', 'bone-kirov' ); ?></th>
            <th><?php	_e( 'Region', 'bone-kirov' ); ?></th>
            <th><?php	_e( 'Population', 'bone-kirov' ); ?></th>
            <th><?php	_e( 'Add to Favorites', 'bone-kirov' ); ?> </th>
          </tr>
        </thead>
        <tbody>
      <?php
        if($conuntries ->have_posts()){
          while ($conuntries->have_posts()) {
            $conuntries->the_post();
            $slug = basename( get_permalink() );

            $existStatus = 'no';
            if (is_user_logged_in()) {
              $existQuery = new WP_Query(array(
                'author' => get_current_user_id(),
                'post_type' => 'favourite',
                'meta_query' => array(
                  array(
                    'key' => 'favorite_id',
                    'compare' => '=',
                    'value' => get_the_ID()
                  )
                )
              ));

              if ($existQuery->found_posts) {
                $existStatus = 'yes';
              }
            }
            ?>
            <tr>
              <td><?php echo get_the_title(); ?></td>
              <td><?php echo get_field('region');?></td>
              <td><?php echo get_field('population');?></td>
              <td> <?php


                ?>

                <a class="country__favorite" data-fav="<?php echo $existQuery->posts[0]->ID ;?>"  data-exists="<?php echo $existStatus ?>" data-user-id="<?php echo get_current_user_id() ?>" data-id="<?php echo get_the_ID(); ?>" href="#<?php echo $slug ?>">
                <span class="add__fav">Add to</span> <span class="remove__fav"> Remove from </span> Favorites </a>

              </td>
            </tr>
          <?php }
        }
      ?>
        </tbody>
      </table>
    <?php } else {
      echo '<h2> Please Login or Add Favourite from <a href="'.home_url().'">here</a>';
    } ?>
    </div>
  </section>

<?php
  get_footer();
?>
