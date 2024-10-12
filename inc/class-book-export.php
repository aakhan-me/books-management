<?php

class BMP_Book_Export {

    // Handle CSV export
    public static function export_to_csv() {
        // Only proceed if the user has the required permissions.
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        // Query all books (or add filters here if needed).
        $args = array(
            'post_type' => 'book',
            'posts_per_page' => -1, // Get all books
        );
        $books_query = new WP_Query( $args );

        // Set headers for CSV download.
        header( 'Content-Type: text/csv; charset=utf-8' );
        header( 'Content-Disposition: attachment; filename=books.csv' );
        $output = fopen( 'php://output', 'w' );

        // Add column headers to CSV.
        fputcsv( $output, array( 'Title', 'Author', 'Publisher', 'ISBN', 'Published Date', 'Zip', 'State', 'Country' ) );

        // Add book data to CSV.
        if ( $books_query->have_posts() ) {
            while ( $books_query->have_posts() ) {
                $books_query->the_post();

                // Get post metadata.
                $author = get_post_meta( get_the_ID(), 'book_author', true );
                $publisher = get_post_meta( get_the_ID(), 'book_publisher', true );
                $isbn = get_post_meta( get_the_ID(), 'book_isbn', true );
                $published_date = get_post_meta( get_the_ID(), 'book_published_date', true );
                $zip = get_post_meta( get_the_ID(), 'book_zip', true );
                $state = get_post_meta( get_the_ID(), 'book_state', true );
                $country = get_post_meta( get_the_ID(), 'book_country', true );

                // Ensure published_date is formatted correctly in YYYY-MM-DD.
                if ( ! empty( $published_date ) ) {
                    $published_date = date( 'Y-m-d', strtotime( $published_date ) );
                } else {
                    $published_date = ''; // Empty if no date is provided.
                }

                // Add book data to CSV row.
                fputcsv( $output, array( get_the_title(), $author, $publisher, $isbn, $published_date, $zip, $state, $country ) );
            }
        }

        // Close the output stream.
        fclose( $output );

        // Exit to avoid further WordPress processing.
        exit;
    }
}

// Hook the export action for logged-in users.
add_action( 'admin_post_bmp_export_csv', array( 'BMP_Book_Export', 'export_to_csv' ) );
