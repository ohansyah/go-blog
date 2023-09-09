<p align="center">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" alt="GO-Blog" width="500">
</p>

[![PHP](https://img.shields.io/badge/PHP-%5E8.1-blue)](https://www.php.net/) [![Laravel](https://img.shields.io/badge/Laravel-%5E10.10-blue)](https://laravel.com/) [![Laravel Jetstream](https://img.shields.io/badge/Laravel_Jetstream-%5E3.2-blue)](https://jetstream.laravel.com/) [![Livewire](https://img.shields.io/badge/Livewire-%5E2.12-blue)](https://laravel-livewire.com/) [![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-%5E2.2-blue)](https://tailwindcss.com/) [![DaisyUI](https://img.shields.io/badge/DaisyUI-%5E2.5-blue)](https://daisyui.com/) [![TinyMCE](https://img.shields.io/badge/TinyMCE-^5-blue)](https://www.tiny.cloud/)


GO-Blog is a Laravel-based project aimed at creating a powerful and user-friendly blogging platform. It provides a robust backend powered by PHP and the Laravel Framework, along with a modern front-end interface using Livewire.

This project leverages the following technologies:

-   **PHP** (`^8.1`) - The programming language powering the backend of the application.
-   **Laravel Framework** (`^10.10`) - A powerful PHP framework for web application development.
-   **Laravel Jetstream** (`^3.2`) - A beautifully designed application scaffolding for Laravel.
-   **Livewire** (`^2.12`) - A full-stack framework for building dynamic user interfaces in Laravel.
-   **Tailwind CSS** (`^2.2`) - A utility-first CSS framework for rapidly building custom user interfaces.
-   **DaisyUI** (`^2.5`) - A component library for Tailwind CSS.
-   **TinyMCE** - Empowering content creation with a user-friendly rich text editor, making sharing your knowledge a breeze.

## Laravel Blog Project Roadmap

This roadmap outlines the progression of the Laravel blog project, highlighting the key phases and tasks involved.

### Phase 1: Basic Setup and Functionality

1. Set up Laravel project with Jetstream and Livewire.

    - [x] Install Laravel using the Laravel installer or Composer.
    - [x] Create a new Laravel project with the desired name.
    - [x] Install Jetstream and choose the Livewire stack during installation.
    - [x] Configure the database settings in the `.env` file.
    - [x] Generate the application key using `php artisan key:generate`.
    - [x] Run the migration and seed the database with dummy data using `php artisan migrate --seed`.
    - [x] Test the basic setup by accessing the application in the browser.
    - [x] Configure logging daily (7).
    - [x] Configure logging query, bindings, time.

2. Configure authentication and user management.
    - [x] Generate authentication scaffolding using Jetstream: `php artisan jetstream:install livewire`.
    - [x] Customize the authentication views and routes as needed.
    - [x] Test the authentication functionality by registering, logging in, and logging out.

### Phase 2: Core Functionality

3. Create blog model and migration.

    - [x] Generate a migration for the blog posts table: `php artisan make:migration create_blog_posts_table`.
    - [x] Define the structure of the blog posts table in the migration file.
    - [x] Run the migration: `php artisan migrate`.

4. Implement CRUD operations for blog posts.

    - [x] Create PostController and routes `php artisan make:controller PostController --resource`.
    - [x] Create Post Model `php artisan make:model Post`.
    - [x] Create a Livewire component for managing blog posts, such as `PostIndex`, `PostCreate`, `PostEdit`, and `PostShow`.
    - [x] Define the necessary properties and methods in each Livewire component.
    - [x] Implement the logic for creating, editing, and deleting blog posts using Laravel's Eloquent ORM.
    - [x] Render the appropriate views and wire up the Livewire components with the necessary routes.

5. Design views for creating, editing, and displaying blog posts.
    - [x] Use Blade templates to design the views for creating, editing, and displaying blog posts.
    - [x] Style the views using Tailwind CSS classes and components.
    - [x] Leverage Livewire's data binding and wire directives to create dynamic and interactive UI elements.

### Phase 3: Enhancements

6. Implement authorization for managing blog posts.

    - [x] Define authorization policies or gates for managing blog posts.
    - [x] Restrict access to create, edit, and delete operations based on user roles and permissions.
    - [x] Add appropriate authorization checks in the Livewire components and views.

7. Integrate a rich text editor for content creation.

    - [X] Choose a rich text editor library such as TinyMCE or CKEditor.
    - [x] Install the library using a package manager or include it directly in your project.
    - [x] Integrate the rich text editor into the create and edit views.
    - [x] Implement the necessary JavaScript code to handle content formatting and interactions.

8. Add image upload functionality for blog posts.

    - [x] Implement file upload handling using Laravel's file system features.
    - [x] Update the create and edit views to include an image upload field.
    - [x] Store the uploaded images in a designated folder and associate them with the corresponding blog posts.

9. Implement pagination for the blog listing page.
    - [x] Use Laravel's pagination features to paginate the list of blog posts.
    - [x] Update the blog listing view to display paginated results.
    - [x] Implement navigation links to switch between different pages.

### Phase 4: Additional Features

10. Integrate a commenting system for blog posts.

    - [x]   Create a Comment model and migration for storing comments.
    - [x]   Establish a relationship between the Comment and Post models.
    - [x]   Design and implement a Livewire component for adding and displaying comments.
    - [x]   Update the PostShow view to render the comments component and allow users to leave comments.
    - [x]   Implement live updates using Livewire.

11. Implement categories and tags for organizing blog posts.

    - [x]   Create models and migrations for categories and tags.
    - [x]   Define relationships between the Category, Tag, and Post models.
    - [x]   Update the database schema and seed the categories and tags data.
    - [x]   Modify the views and components to display and filter blog posts by categories and tags.

12. Enable social sharing of blog posts.

    - [ ]   Integrate social sharing buttons for popular platforms like Facebook, Twitter, and LinkedIn.
    - [ ]   Generate appropriate share links with the post's URL and title.
    - [ ]   Add the social sharing buttons to the PostShow view.

13. Test the blog thoroughly for functionality and user experience.

    - [ ]   Conduct comprehensive testing of all features, including creating, editing, and deleting blog posts, authentication, and user management.
    - [ ]   Test the blog across multiple devices and browsers to ensure responsiveness and compatibility.
    - [ ]   Verify that the SEO enhancements are correctly implemented and functioning as expected.

14. Gather feedback and make necessary refinements.

    - [ ]   Solicit feedback from users or colleagues to identify any usability or functionality issues.
    - [ ]   Address any reported bugs or usability concerns promptly.
    - [ ]   Make necessary adjustments to improve the user experience and overall quality of the blog.

15. Optimize performance and security.
    - [ ]   Analyze and optimize the performance of your application, including database queries, code efficiency, and caching.
    - [ ]   Implement security measures, such as input validation, CSRF protection, and user authorization checks, to ensure the safety of your blog.

### Phase 5: SEO Enhancements

16. Enhance SEO by generating search-friendly URLs and adding meta tags.
    - [x]   Customize the routes to generate SEO-friendly URLs for blog posts.
    - [x]   Update the views and Livewire components to include appropriate meta tags, such as title, description, and keywords.
    - [ ]   Implement a sitemap.xml file to help search engines index your blog posts.
    - [ ]   Consider implementing canonical URLs, structured data, and other SEO best practices to improve search engine visibility.

### Phase 6: Unit Test
17. Write Unit Test.
    - [ ]   Post - Create.
    - [ ]   Post - View.
    - [ ]   Post - Edit.
    - [ ]   Comment - Create.
    

### Phase 7: Refactor and Perform Enhancements
18. Refractor Controller to Service Layer.
    - [ ]   PostController.
    - [ ]   CommentController.

19. Refractor reusable VIew Component.
    - [ ]   Post.
    - [ ]   Comment.

### Phase 8: Additional Features
20. Post - Like and Count.
    - [ ]   Create Like Model and Migration.
    - [ ]   Create Like Controller.
    - [ ]   Create Like Component.
    - [ ]   Create Like Unit Test.

21. Comment - Reply.
    - [ ]   Able to reply to comment.

22. Dashboard Notification.
    - [ ]   Post - Like.
    - [ ]   Post - Comment.
    - [ ]   Comment - Reply.

23. Search Feature using Laravel Scout.
    - [ ]   Able to search post by title.
    - [ ]   Able to search post by Category and Tags.

24. Image functionality for blog posts.
    - [ ]   compress image as thumbnail.
    - [ ]   list - image thumbnail.
    - [ ]   show - image original size.
