Library Management System
Project Overview
This project is a Library Management System developed in vanilla PHP, with frontend styling using Bootstrap and JavaScript for added functionality, including filtering options. It allows users to explore a collection of books, authors, and categories, and includes a commenting system for book reviews and notes.

Features
User Registration and Login
Users: Anyone can register and log in to explore the library and post comments on books.
Admin: There is a hard-coded admin account for management purposes:
Username: admin
Password: admin
Comments
User Comments: Logged-in users can write comments on book pages.
Approval System: All comments require approval by the admin before they are visible to other users.
Notes
AJAX Notes: Users can create notes related to books using AJAX and jQuery for seamless interaction without reloading the page. Notes are saved and dynamically updated.
Categories and Filters
Book Categories: Books are organized into various categories.
JavaScript Filters: Users can filter books by categories and authors using JavaScript for improved browsing.
Tech Stack
Backend: PHP
Frontend: Bootstrap, JavaScript, jQuery, and AJAX
Admin Capabilities
The admin user has access to manage:

Books: Add, edit, or remove books with authors and category.
Authors: Add, edit, or softdelete author information.
Categories: Add, edit, or softdelete categories.
Comments: Approve or delete user-submitted comments.
Installation and Setup
Clone the repository to your local server.
Import the database (database file provided "Project2.sql") and configure the database connection in conobj.php.
Launch the app on your preferred PHP server, and log in as admin to access management features.
