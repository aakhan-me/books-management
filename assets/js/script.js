jQuery(document).ready(function($) {
    // Search input event listener.
    $('#book-search').on('input', function() {
        var searchTitle = $(this).val();
        var author = $('#book-author').val();
        var publisher = $('#book-publisher').val();

        // Make AJAX request to search for books.
        $.ajax({
            url: bmp_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'bmp_search_books',
                search_title: searchTitle,
                author: author,
                publisher: publisher
            },
            success: function(response) {
                if (response.success) {
                    $('#book-list').html(response.data.html);
                }
            }
        });
    });
});
