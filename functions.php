<?php 

/**
 * Category post
 */
// Creating Shortcodes to display posts from category
function text_domain_category_post($attr, $content = null){
 
    global $post;
 
    // Defining Shortcode's Attributes
    $shortcode_args = shortcode_atts(
        array(
                'cat'    => '',
                'num'    => '2',
                'order'  => 'desc'
        ), $attr);  
     
    // array with query arguments
    $args = array(
            'cat'            => $shortcode_args['cat'],
            'posts_per_page' => $shortcode_args['num'],
            'order'          => $shortcode_args['order'],
             
         );
 
     
    $recent_posts = get_posts($args);

    $output .= '<div class="cat-post-row">';
 
        foreach ($recent_posts as $post) :
             
            setup_postdata($post);

            $output .= '<div class="col-lg-6"><div class="single-cat-post">';

                $output .= '<div class="cat-post-img">';
                    $output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail( $post, 'post-thumbnail').'</a>';
                $output .= '</div>';

                $output .= '<ul class="cat-post-meta">';
                    $output .= '<li>'.get_the_author().'</li>';
                    $output .= '<li>'.get_the_date().'</li>';
                $output .= '</ul>';
            
                $output .= '<a href="'.get_permalink().'"><h3>'.get_the_title().'</h3></a>'; 

                $output .= 'p'.get_the_excerpt( $post ).'</p>';

            $output .= '</div></div>';

     
        endforeach; 
         
        wp_reset_postdata();

    $output .= '</div>';
     
    return $output;
 
}
 
add_shortcode( 'catPost', 'text_domain_category_post' );
