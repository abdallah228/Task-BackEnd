# Task BackEnd

this project is task for making api (cruds users , products and Auth system )

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)


## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/your-username/your-project.git
    ```

2. **Change into the project directory:**

    ```bash
    cd your-project
    ```

3. **Install dependencies:**

    ```bash
    composer install
    ```

4. **Copy the `.env.example` file to `.env`:**

    ```bash
    cp .env.example .env
    ```

5. **Generate an application key:**

    ```bash
    php artisan key:generate
    ```

6. **Configure the database in the `.env` file:**

    ```env
    DB_CONNECTION=mysql
    DB_HOST=your-database-host
    DB_PORT=your-database-port
    DB_DATABASE=your-database-name
    DB_USERNAME=your-database-username
    DB_PASSWORD=your-database-password
    ```

7. **Migrate the database:**

    ```bash
    php artisan migrate
    ```

8. **Seed the database (if needed):**

    ```bash
    php artisan db:seed
    ```

## Usage

### API Endpoints

#### User Authentication

- **Register a New User:**
  ```http
  POST /api/register

In the "Usage" section of your README, you should provide instructions on how someone can use and interact with your project. Here's a general guide on what you might include:

markdown
Copy code
## Usage

### API Endpoints

#### User Authentication

- **Register a New User:**
  ```http
  POST /api/register
        Request Body:

            name (string): User's full name.
            user_name (string): User's unique username.
            password (string): User's password (min 6 characters).
            avatar (file): User's profile picture.
            type (enum): User type (gold, silver).
   -Log In:
        POST /api/login
            Request Body:
            user_name (string): User's username.
            password (string): User's password.
    User Management
        Get All Users:
            GET /api/users
        Get a Specific User:
            GET /api/users/{id}
        Create a New User:
            POST /api/users
                Request Body: (Similar to registration)
        Update a User:
                PUT /api/users/{id}
                    Request Body: (Similar to registration, optional fields)
        Delete a User:
                DELETE /api/users/{id}
        Product Management
                Get All Products:
                    GET /api/products
                Get a Specific Product:
                    GET /api/products/{id}
                Create a New Product:
                    POST /api/products
                        Request Body:
                            name (string): Product name.
                            description (string): Product description.
                            image (file): Product image.
                            price (numeric): Product price.
                            slug (string): Product slug.
                            is_active (boolean, optional): Product status.
                Update a Product:
                    PUT /api/products/{id}
                    Request Body: (Similar to product creation, optional fields)
                Delete a Product:   
                    DELETE /api/products/{id}

            Price Adjustment Based on User Type
                Adjust Product Prices:
                After a user is authenticated, product prices are automatically adjusted based on their type.

















### Running the Development Server

```bash
php artisan serve
