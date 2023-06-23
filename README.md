# EEC Group Assignment

This project is an EEC Group Assignment that demonstrates a basic Laravel 10 application with CRUD operations and user authentication. It also includes an example of integrating DataTables to display a list of products in a table using the DataTables jQuery library and server-side processing.

## Requirements

- PHP >= 8.1
- Laravel 10.x
- Composer
- Node.js and npm
- Yajra/laravel-datatables package
- jQuery
- DataTables library

## Installation

1. Clone the repository: `git clone https://github.com/LotfyAymanElnaggar/eec-group-assignment.git`

2. Change to the project directory: `cd eec-group-assignment`

3. Install the PHP dependencies: `composer install`

4. Install the JavaScript dependencies: `npm install`

5. Copy the `.env.example` file to create a `.env` file: cp .env.example .env

6. Update the `.env` file with your database configuration and other environment-specific settings.

7. Generate a new application key: `php artisan key:generate`

8. Run the database migrations: `php artisan migrate`

9. (Optional) Seed the database with sample data: `php artisan db:seed`

10. Start the local development server: `php artisan serve`

Now, you can visit the application at `http://localhost:8000`.

## DataTables Integration

To view the DataTables integration example, navigate to the `/products` endpoint in your application (e.g., `http://localhost:8000/products`). This will display a list of products in a table using the DataTables library with server-side processing.

Make sure to adjust the model and column names as needed to match your specific use case.

## License

This project is open-source and licensed under the [MIT license](LICENSE).
