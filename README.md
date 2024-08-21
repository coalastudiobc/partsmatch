<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Built With

This section lists any major frameworks/libraries used to bootstrap your project. Add-ons and plugins should be listed in the acknowledgements section.

- **[Laravel](https://laravel.com/)** - A PHP framework for web application development
- **[Php](https://www.php.net/)** - A fast, small, and feature-rich JavaScript library 
- **[Bootstrap](https://getbootstrap.com/)** - A front-end framework for developing responsive websites
- **[jQuery](https://jquery.com/)** - A fast, small, and feature-rich JavaScript library 

## Getting Started

This guide will help you set up and run the project locally. Follow these instructions to get a copy up and running on your local machine.

## Prerequisites

Before you begin, ensure you have met the following requirements:

- **PHP**: Laravel requires PHP version 7.3 or higher. Install PHP from [php.net](https://www.php.net/) or use a package manager like [Homebrew](https://brew.sh/) for macOS.

- **Composer**: Dependency manager for PHP. Install Composer from [getcomposer.org](https://getcomposer.org/).

- **MySQL or MariaDB**: Database management system. Install MySQL or MariaDB from [mysql.com](https://www.mysql.com/) or [mariadb.org](https://mariadb.org/), respectively. Ensure you have a database user and database created for your Laravel application.

- **Node.js and npm**: Required for managing JavaScript dependencies. Install Node.js and npm from [nodejs.org](https://nodejs.org/).

- **Laravel Installer (Optional)**: Install Laravel globally using Composer for easier project setup:

    ```bash
    composer global require laravel/installer
    ```

- **Git**: Version control system. Install Git from [git-scm.com](https://git-scm.com/).

- **Apache or Nginx**: Web server for serving your Laravel application. You can install Apache or Nginx from their respective websites or use a local development environment like [XAMPP](https://www.apachefriends.org/) or [Laravel Homestead](https://laravel.com/docs/9.x/homestead).

Ensure that you have all the required software installed and properly configured before proceeding with the installation of your Laravel project.


### Installation

Follow these steps to set up the project:

1. **Get a Car API Key**: Sign up at [carapi.app](https://carapi.app/) to obtain an API key.
2. **Get a Shippo API Key**: Sign up at [shippo.com](https://apps.goshippo.com) to obtain an API key.

2. **Clone the repository**: Copy the repository to your local machine:

    ```bash
    git clone https://github.com/github_username/repo_name.git
    ```

3. **Install NPM packages**: Navigate to the project directory and install the required packages:

    ```bash
    cd repo_name
    npm install
    composer update
    ```

4. **Install PHP dependencies**: Install Laravel’s PHP dependencies using Composer:

    ```bash
    composer install
    ```

5. **Configure your API keys**: Open the `.env` file in the project root and set your API keys and other environment-specific settings. Add or update the necessary environment variables:

    ```dotenv
    API_KEY=ENTER_YOUR_API_KEY
    ```

6. **Generate an application key**: Laravel requires an application key to be set. Generate this key using Artisan:

    ```bash
    php artisan key:generate
    ```

7. **Set up your database**: Configure your database connection settings in the `.env` file:

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

8. **Run migrations**: Apply the database migrations to set up your database schema:

    ```bash
    php artisan migrate
    ```

9. **Serve the application**: Start the Laravel development server:

    ```bash
    php artisan serve
    ```

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
