# TMDb CC backend

This was made for a technical test, this is not a real or production ready project.

## Getting Started

Follow these steps to get the project up and running on your local machine.

### 1. Copy the `.env.example` file to `.env` and set the `TMDB_API_TOKEN`

First, you need to create your environment file. Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Next, open the `.env` file and set the `TMDB_API_TOKEN` environment variable. You can obtain your API token by signing up at [TMDB](https://developer.themoviedb.org/).
The token should be available on TMDb's site [here](https://developer.themoviedb.org/reference/intro/authentication) once you're logged in.

```ini
TMDB_API_TOKEN=your_api_token_here
```

### 2. Install Composer Dependencies

Run the following command to install the PHP dependencies:

```bash
composer install
```

### 3. Run Database Migrations

Set up the database by running the migrations:

```bash
php artisan migrate
```

### 4. Generate the Application Key

Finally, generate a new application key for Laravel:

```bash
php artisan key:generate
```

### 5. You're Ready to Go!

At this point, your application should be up and running. You can now start the local development server:

```bash
composer dev run
```

The API endpoints should now be available on `http://localhost:8000/api`.
