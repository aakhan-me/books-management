<div class="wrap">
    <h1><?php _e( 'All Books', 'book-management' ); ?></h1>

    <form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>">
        <input type="hidden" name="action" value="bmp_export_csv" />
        <input type="submit" class="button-primary" value="Export to CSV" />
    </form>

    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th><a href="?page=book-management&orderby=title&order=<?php echo $order === 'asc' ? 'desc' : 'asc'; ?>"><?php _e( 'Title', 'book-management' ); ?></a></th>
                <th><a href="?page=book-management&orderby=book_author&order=<?php echo $order === 'asc' ? 'desc' : 'asc'; ?>"><?php _e( 'Author', 'book-management' ); ?></a></th>
                <th><?php _e( 'Publisher', 'book-management' ); ?></th>
                <th><?php _e( 'ISBN', 'book-management' ); ?></th>
                <th><?php _e( 'Published Date', 'book-management' ); ?></th>
                <th><?php _e( 'Actions', 'book-management' ); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if ( $books_query->have_posts() ) : ?>
                <?php while ( $books_query->have_posts() ) : $books_query->the_post(); ?>
                    <tr>
                        <td><?php echo esc_html( get_the_title() ); ?></td>
                        <td><?php echo esc_html( get_post_meta( get_the_ID(), 'book_author', true ) ); ?></td>
                        <td><?php echo esc_html( get_post_meta( get_the_ID(), 'book_publisher', true ) ); ?></td>
                        <td><?php echo esc_html( get_post_meta( get_the_ID(), 'book_isbn', true ) ); ?></td>
                        <td><?php echo esc_html( get_post_meta( get_the_ID(), 'book_published_date', true ) ); ?></td>
                        <td>
                            <a href="<?php echo admin_url( 'admin.php?page=book-management&action=delete&book_id=' . get_the_ID() ); ?>" onclick="return confirm('Are you sure you want to delete this book?');"><?php _e( 'Delete', 'book-management' ); ?></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6"><?php _e( 'No books found.', 'book-management' ); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="tablenav">
        <?php
        $pagination_args = array(
            'total' => $total_pages,
            'current' => $paged,
            'base' => add_query_arg( array( 'paged' => '%#%' ) ),
            'format' => '?paged=%#%',
        );
        echo paginate_links( $pagination_args );
        ?>
    </div>
</div>
