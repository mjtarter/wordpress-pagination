<?php
//Display posts from the current page and set the ‘paged’ parameter to 1 when the query variable is not set (first page).
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$attr = array(
  'posts_per_page' => 5,
  'post_type' => 'your_post_type',
  'paged' => $paged, //number of page
);
$query = new WP_Query($attr);
if($query->have_posts()){?>
  <?php while($query->have_posts()){ $query->the_post();?>
    YOUR CONTENT HERE
  <?php } ?>

  <?php
  $big = 999999999; // need an unlikely integer
  echo paginate_links( array(
      'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'format' => '?paged=%#%',
      'current' => max( 1, get_query_var('paged') ),
      'total' => $query->max_num_pages
  ) );
} ?>
