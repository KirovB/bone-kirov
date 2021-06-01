<?php
  get_header();

  $conuntries = new WP_Query(array(
    'posts_per_page' => -1,
    'post_type' => 'countries',
    'orderby' => 'title',
    'order' => 'ASC',
    ));
?>

  <section id="countries-list" class="container">
    <div class="col-md-12">
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
            ?>
            <tr>
              <td><?php echo get_the_title(); ?></td>
              <td><?php echo get_field('region');?></td>
              <td><?php echo get_field('population');?></td>
              <td> <?php
                $likeCount = new WP_Query(array(
                  'post_type' => 'favourite',
                  'meta_query' => array(
                    array(
                      'key' => 'favorite_id',
                      'compare' => '=',
                      'value' => get_the_ID()
                    )
                  )
                ));


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

                <a class="country__favorite" data-fav="<?php echo $existQuery->posts[0]->ID ;?>"  data-exists="<?php echo $existStatus ?>" data-user-id="<?php echo get_current_user_id() ?>" data-id="<?php echo get_the_ID(); ?>" href="#<?php echo $slug ?>">
                <span class="add__fav">Add to</span> <span class="remove__fav"> Remove from </span> Favorites </a>

              </td>
            </tr>
          <?php }
        }
      ?>
        </tbody>
      </table>
    </div>
  </section>

<?php
  get_footer();
?>
