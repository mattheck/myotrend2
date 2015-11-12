<?php 

#-----------------------------------------------------------------#
# SVG media uploads
#-----------------------------------------------------------------#
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

#-----------------------------------------------------------------#
# add tag support to pages
#-----------------------------------------------------------------#
// add tag support to pages
function tags_support_all() {
	register_taxonomy_for_object_type('post_tag', 'page');
}

// ensure all tags are included in queries
function tags_support_query($wp_query) {
	if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
}

// tag hooks
add_action('init', 'tags_support_all');
add_action('pre_get_posts', 'tags_support_query');

#-----------------------------------------------------------------#
# Exclude Category from Shop
#-----------------------------------------------------------------#

add_filter( 'get_terms', 'get_subcategory_terms', 10, 3 );

function get_subcategory_terms( $terms, $taxonomies, $args ) {

  $new_terms = array();

  // if a product category and on the shop page
  if ( in_array( 'product_cat', $taxonomies ) && ! is_admin() && is_shop() ) {

    foreach ( $terms as $key => $term ) {

      if ( ! in_array( $term->slug, array( 'all-products', 'amino-acid', 'heart-health', 'joint-health', 'lean-gainer', 'multivitamin', 'muscle-building', 'nitric-oxide', 'nitric-oxide-booster', 'pre-workout', 'protein', 'pump', 'recovery', 'test-booster', 'thermogenic', 'weight-loss') ) ) {
        $new_terms[] = $term;
      }

    }

    $terms = $new_terms;
  }

  return $terms;
}

#-----------------------------------------------------------------#
# Exclude Posts from Search
#-----------------------------------------------------------------#
function exclude_posts($query) {
    if ($query->is_search) {
       $query->set('cat','Post ID here');
  }
  return $query;
}
add_filter('pre_get_posts','exclude_posts');
?>
