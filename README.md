# Address Manager

Welcome to the Address Manager repository! This project is built with Laravel and uses the getAddress.io API

## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Running the Application](#running-the-application)
- [Testing](#testing)
- [Deployment](#deployment)
- [Contributing](#contributing)
- [License](#license)

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL or any other database

## Installation

1. **Clone the repository**

    ```sh
    git clone https://github.com/alantucker/address-manager.git
    cd your-repository
    ```

2. **Install dependencies**

    - **Composer dependencies**

        ```sh
        composer install
        ```

    - **NPM dependencies**

        ```sh
        npm install
        npm run build
        ```
      
3. **Asset Bundling (Vite)**

There are two ways you can run Vite. You may run the development server via the `dev` command, which is useful while developing locally. The development server will automatically detect changes to your files and instantly reflect them in any open browser windows.

Or, running the `build` command will version and bundle your application's assets and get them ready for you to deploy to production:

Run the Vite development server...

```sh
npm run dev
```

Build and version the assets for production...

```sh
npm run build
```

Detailed information can be found in the [Laravel docs](https://laravel.com/docs/11.x/vite)


## Configuration

1. **Environment variables**

   Copy the `.env.example` file to `.env`:

    ```sh
    cp .env.example .env
    ```

   Then, open the `.env` file and update the necessary environment variables, such as database credentials and application settings.

2. **Generate an application key**

    ```sh
    php artisan key:generate
    ```

3. **Using getAddress.io service**

    getAddress.io offers a free plan which you can [signup to](https://admin.getaddress.io/account/sign-up). Once you have signed up make sure you add your API key to the `ADDRESS_API_KEY` to your `.env` file

## Running the Application

1. **Run database migrations**

    ```sh
    php artisan migrate
    ```

2. **Start the local development server**

    ```sh
    php artisan serve
    ```

   The application will be available at `http://localhost:8000`.

## Testing

To run the tests, execute:

```sh
php artisan test
