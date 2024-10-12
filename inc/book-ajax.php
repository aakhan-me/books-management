<?php

// AJAX handler for book search.
add_action( 'wp_ajax_bmp_search_books', 'bmp_search_books' );
add_action( 'wp_ajax_nopriv_bmp_search_books', 'bmp_search_books' );

function bmp_search_books() {
    // Check for the search query, author, and publisher.
    $search_value = isset( $_POST['search_title'] ) ? sanitize_text_field( $_POST['search_title'] ) : '';
    $author = isset( $_POST['author'] ) ? sanitize_text_field( $_POST['author'] ) : '';
    $publisher = isset( $_POST['publisher'] ) ? sanitize_text_field( $_POST['publisher'] ) : '';

    // Generate the book list based on the search query, author, and publisher.
    $books_html = bmp_get_books_list_html( $author, $publisher, $search_value );

    // Return the HTML for the filtered book list.
    wp_send_json_success( array( 'html' => $books_html ) );
}

