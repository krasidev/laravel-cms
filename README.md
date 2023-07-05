## Laravel CMS (Current: Laravel 8.*)

Laravel CMS is a simple CMS system based on the Laravel 8.* and PHP 8.1.*

Integration with Google Analytics 4 has been made to download and visualize base data.

## Setup

Clone the repo and follow below steps.
1. Run `composer install`
2. Copy `.env.example` to `.env`
3. Set valid database credentials of env variables `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`
4. Run `php artisan key:generate` to generate application key
5. Run `php artisan migrate`
7. Run `php artisan db:seed` to seed your database
8. Run `npm i` (Recommended node version `>= V18.16.0`)
9. Run `npm run dev` or `npm run prod` as per your environment

## Demo Credentials

**Email:** admin@example.com\
**Password:** qwerty

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## ScreenShots

## Home

![Screenshot](screenshots/home.png)

## Google Analytics - Overview

![Screenshot](screenshots/google-analytics-overview.png)

## List Projects

![Screenshot](screenshots/projects.png)

## List Deleted Projects

![Screenshot](screenshots/deleted-projects.png)

## Create Project

![Screenshot](screenshots/create-project.png)

## List Users

![Screenshot](screenshots/users.png)

## List Deleted Users

![Screenshot](screenshots/deleted-users.png)
