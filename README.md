# Book Management Plugin

## Description
A WordPress plugin to manage books with custom fields (Author, Publisher, ISBN, Published Date, Zip, State, and Country). The plugin adds custom admin pages to add, display, and delete books, includes sorting, pagination, CSV export, and AJAX-powered search functionality.

## Features
- Create and manage a custom post type for books with fields: Title, Author, Publisher, ISBN, Published Date, Zip, State, and Country.
- Custom admin pages to add new books, view all books, and delete books.
- AJAX search functionality to dynamically search books by title and custom fields (Author, Publisher, ISBN, Zip, State, and Country).
- CSV export functionality to download all book data.
- Front-end shortcode to display books filtered by author and publisher with a search feature.

## Installation
1. Upload the `book-management-plugin` folder to `/wp-content/plugins/`.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Use the "Book Management" menu in the WordPress admin dashboard to add and manage books.

## Usage
- Use the `[display_books author="Author Name" publisher="Publisher Name"]` shortcode to display filtered books on any page.
- The shortcode supports dynamic searching and filtering of books by the given author or publisher.
- For example: [display_books author="J.K. Rowling" publisher="Penguin Books"]

This will display all books by J.K. Rowling and Penguin Books. The user can also search by title and other custom fields like ISBN, State, or Zip.

## Custom Search Functionality
The plugin provides AJAX-powered search functionality, which allows users to dynamically search for books by title and custom fields (Author, Publisher, ISBN, Zip, State, and Country) without page reloads. This functionality is available both in the admin area and on the front end when using the shortcode.

## Custom Admin Pages
All Books: Lists all books in a table format with sorting and pagination. You can also delete books from this page.
Add New Book: Allows you to add new books with the required custom fields.
Export to CSV: Provides a button to export all books in CSV format.

## License
This plugin is open-source and freely available to modify and distribute.