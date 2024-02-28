# Leadz_Test_API

## Description

    Leadz_Test_API is an API created to manage a 'Library' so users can brows their favorite Books with minimale effort
    due to its simplicity.

## Features

-   Browse All Books available on the plateform
-   View a book's details
-   Browse All Authors available on the plateform
-   View an author's details
-   Search for Books by (title || genre || author )
-   Search for Authors by (first name || last name)
-   Read other users thoughts via reviews provided in each book's detail page

## Technologies
-   [Composer](https://getcomposer.org/download/)
-   [Symfony-CLI](https://symfony.com/download)
-   [MakerBundle](https://symfony.com/bundles/SymfonyMakerBundle/current/index.html)
-   [PostgreSQL](https://www.postgresql.org/download/)
-   [API Platform](https://api-platform.com/docs/distribution/)

## Installation

### Steps

-   Ensure you have Composer and Symfony-CLI installed
-   Clone the repository
-   Run `composer install` to install dependencies
-   Create a `.env` file and copy the `.env.example` make sure you change the password and put yours
-   Run `symfony console doctrine:database:create ` to create your database
-   Run `symfony console doctrine:migrations:migrate ` to migrate all the tables to your database
-   Run `symfony serve ` to start your API
