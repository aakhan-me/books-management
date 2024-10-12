<div class="wrap">
    <h1><?php _e( 'Add New Book', 'book-management' ); ?></h1>

    <form method="post">
        <input type="hidden" name="action" value="add_new_book" />
        <table class="form-table">
            <tr>
                <th><label for="book_title"><?php _e( 'Title', 'book-management' ); ?></label></th>
                <td><input type="text" name="book_title" id="book_title" class="regular-text" required /></td>
            </tr>
            <tr>
                <th><label for="book_author"><?php _e( 'Author', 'book-management' ); ?></label></th>
                <td><input type="text" name="book_author" id="book_author" class="regular-text" required /></td>
            </tr>
            <tr>
                <th><label for="book_publisher"><?php _e( 'Publisher', 'book-management' ); ?></label></th>
                <td><input type="text" name="book_publisher" id="book_publisher" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="book_isbn"><?php _e( 'ISBN', 'book-management' ); ?></label></th>
                <td><input type="text" name="book_isbn" id="book_isbn" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="book_published_date"><?php _e( 'Published Date', 'book-management' ); ?></label></th>
                <td><input type="text" name="book_published_date" id="book_published_date" class="regular-text datepicker" /></td>
            </tr>
            <tr>
                <th><label for="book_zip"><?php _e( 'Zip Code', 'book-management' ); ?></label></th>
                <td><input type="text" name="book_zip" id="book_zip" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="book_state"><?php _e( 'State', 'book-management' ); ?></label></th>
                <td><input type="text" name="book_state" id="book_state" class="regular-text" readonly /></td>
            </tr>
            <tr>
                <th><label for="book_country"><?php _e( 'Country', 'book-management' ); ?></label></th>
                <td><input type="text" name="book_country" id="book_country" class="regular-text" readonly /></td>
            </tr>
        </table>

        <p class="submit"><input type="submit" class="button-primary" value="<?php _e( 'Add Book', 'book-management' ); ?>" /></p>
    </form>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#book_zip').on('blur', function() {
        let zip = $(this).val();
        if (zip) {
            $.get(`http://api.zippopotam.us/us/${zip}`, function(data) {
                if (data) {
                    $('#book_state').val(data.places[0]['state abbreviation']);
                    $('#book_country').val('United States');
                }
            });
        }
    });

    // Date picker for published date.
    $('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>
