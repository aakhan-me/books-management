<?php

// Shortcode handler function for displaying books with AJAX search.
function bmp_display_books_shortcode( $atts ) {
    // Extract shortcode attributes
    $atts = shortcode_atts( array(
        'author' => '',
        'publisher' => ''
    ), $atts );

    // Display the search box.
    $output = '<div class="book-search-box">';
    $output .= '<input type="text" id="book-search" placeholder="Search books by title..." />';
    // Hidden inputs to hold the author and publisher values from the shortcode.
    $output .= '<input type="hidden" id="book-author" value="' . esc_attr( $atts['author'] ) . '" />';
    $output .= '<input type="hidden" id="book-publisher" value="' . esc_attr( $atts['publisher'] ) . '" />';
    $output .= '</div>';

    // Add a container for the book list that will be dynamically updated by AJAX.
    $output .= '<ul class="book-list" id="book-list">';
    $output .= bmp_get_books_list_html( $atts['author'], $atts['publisher'] );
    $output .= '</ul>';

    return $output;
}
add_shortcode( 'display_books', 'bmp_display_books_shortcode' );

// Function to get the list of books in HTML format.
function bmp_get_books_list_html( $author = '', $publisher = '', $search_title = '' ) {
    $args = array(
        'post_type' => 'book',
        'posts_per_page' => -1, // Get all books (or limit as needed)
        'meta_query' => array(),
    );

    // Filter by author.
    if ( ! empty( $author ) ) {
        $args['meta_query'][] = array(
            'key' => 'book_author',
            'value' => $author,
            'compare' => 'LIKE',
        );
    }

    // Filter by publisher.
    if ( ! empty( $publisher ) ) {
        $args['meta_query'][] = array(
            'key' => 'book_publisher',
            'value' => $publisher,
            'compare' => 'LIKE',
        );
    }

    // Filter by title (used for AJAX search).
    if ( ! empty( $search_title ) ) {
        $args['s'] = $search_title;
    }

    $books_query = new WP_Query( $args );

    ob_start();

    if ( $books_query->have_posts() ) {
        while ( $books_query->have_posts() ) {
            $books_query->the_post();

            $author = get_post_meta( get_the_ID(), 'book_author', true );
            $publisher = get_post_meta( get_the_ID(), 'book_publisher', true );
            $isbn = get_post_meta( get_the_ID(), 'book_isbn', true );
            $published_date = get_post_meta( get_the_ID(), 'book_published_date', true );
            $zip = get_post_meta( get_the_ID(), 'book_zip', true );
            $state = get_post_meta( get_the_ID(), 'book_state', true );
            $country = get_post_meta( get_the_ID(), 'book_country', true );

            echo '<li>';
            echo '<strong>' . esc_html( get_the_title() ) . '</strong><br>';
            if ( $author ) {
                echo 'Author: ' . esc_html( $author ) . '<br>';
            }
            if ( $publisher ) {
                echo 'Publisher: ' . esc_html( $publisher ) . '<br>';
            }
            if ( $isbn ) {
                echo 'Isbn: ' . esc_html( $isbn ) . '<br>';
            }
            if ( $published_date ) {
                echo 'Published Date: ' . esc_html( $published_date ) . '<br>';
            }
            if ( $zip ) {
                echo 'Zip: ' . esc_html( $zip ) . '<br>';
            }
            if ( $state ) {
                echo 'State: ' . esc_html( $state ) . '<br>';
            }
            if ( $country ) {
                echo 'Country: ' . esc_html( $country ) . '<br>';
            }
            echo '</li>';
        }
    } else {
        echo '<li>No books found matching your criteria.</li>';
    }

    // Reset post data and return the output.
    wp_reset_postdata();
    return ob_get_clean();
}
