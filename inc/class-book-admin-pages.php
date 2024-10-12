<?php

class BMP_Book_Admin_Pages {

    // Display the page with all books.
    public static function display_books_page() {
        // Handle deletion.
        if ( isset( $_GET['action'] ) && $_GET['action'] === 'delete' && isset( $_GET['book_id'] ) ) {
            wp_delete_post( intval( $_GET['book_id'] ), true );
            echo '<div class="notice notice-success is-dismissible"><p>Book deleted successfully!</p></div>';
        }

        // Pagination setup.
        $paged = isset( $_GET['paged'] ) ? max( 1, intval( $_GET['paged'] ) ) : 1;
        $posts_per_page = 10;

        // Sorting.
        $orderby = isset( $_GET['orderby'] ) ? sanitize_text_field( $_GET['orderby'] ) : 'title';
        $order = isset( $_GET['order'] ) ? sanitize_text_field( $_GET['order'] ) : 'asc';

        $args = array(
            'post_type' => 'book',
            'posts_per_page' => $posts_per_page,
            'paged' => $paged,
            'orderby' => $orderby,
            'order' => $order,
        );

        $books_query = new WP_Query( $args );
        $total_books = $books_query->found_posts;
        $total_pages = ceil( $total_books / $posts_per_page );

        include BMP_PLUGIN_DIR . 'templates/admin-books-list.php';
    }

    // Display the page to add a new book.
    public static function display_add_book_page() {
        if ( isset( $_POST['action'] ) && $_POST['action'] === 'add_new_book' ) {
            // Insert new book as a CPT post.
            $book_id = wp_insert_post( array(
                'post_type' => 'book',
                'post_title' => sanitize_text_field( $_POST['book_title'] ),
                'post_status' => 'publish',
            ) );

            // Save custom metadata.
            if ( $book_id ) {
                update_post_meta( $book_id, 'book_author', sanitize_text_field( $_POST['book_author'] ) );
                update_post_meta( $book_id, 'book_publisher', sanitize_text_field( $_POST['book_publisher'] ) );
                update_post_meta( $book_id, 'book_isbn', sanitize_text_field( $_POST['book_isbn'] ) );
                update_post_meta( $book_id, 'book_published_date', sanitize_text_field( $_POST['book_published_date'] ) );
                update_post_meta( $book_id, 'book_zip', sanitize_text_field( $_POST['book_zip'] ) );
                update_post_meta( $book_id, 'book_country', sanitize_text_field( $_POST['book_country'] ) );
                update_post_meta( $book_id, 'book_state', sanitize_text_field( $_POST['book_state'] ) );

                echo '<div class="notice notice-success is-dismissible"><p>Book added successfully!</p></div>';
            }
        }

        include BMP_PLUGIN_DIR . 'templates/admin-add-book-form.php';
    }
}
