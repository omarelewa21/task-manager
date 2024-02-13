Task Management Application
===========================

This is a simple task management web application built with Laravel v10 and Livewire v3. It allows users to create, edit, delete, and reorder tasks with a drag-and-drop interface. Tasks are saved to a MySQL database. Additional functionality includes project-based task organization, enabling users to view tasks associated with specific projects.

Requirements
------------

-   PHP ^8.0
-   MySQL ^5.7 or MariaDB ^10.2
-   Composer
-   Node.js and npm
-   A web server like Apache or Nginx

Installation
------------

### 1\. Clone the Repository

```bash
git clone https://github.com/omarelewa21/task-manager.git
cd task-manager
```

### 2\. Install Dependencies

Install PHP dependencies through Composer.

```bash
composer install
```

Then, install Node.js dependencies and run the development script to compile assets.

```bash
npm install
```

### 3\. Environment Setup

Copy the example environment file and make the necessary adjustments to your database settings.

```bash
cp .env.example .env
```

Edit `.env` to include your database connection details:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4\. Generate Application Key

Generate a new application key. This is crucial for ensuring user sessions and encrypted data remain secure.

```bash
php artisan key:generate
```

### 5\. Run Migrations

Create the database structure by running the migrations.

```bash
php artisan migrate
```

### 7\. Serve the Application

Use Laravel's built-in server to run your application.

```bash
npm run dev

php artisan serve
```

Your application will be accessible at `http://localhost:8000`.


License
-------

The Laravel framework is open-sourced software licensed under the MIT license.
