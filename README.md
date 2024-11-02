# GitHub API Project

This is a Laravel API project for Github. Authenticated user can manage all his starred repos in github by attaching tags to them.

## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/MmdReza-Alikhani/GitHub-API.git
    cd your-repo-name
    

2. Install dependencies:
    ```sh
    composer install
    ```

3. Install a LocalServer (especially Laragon):
    https://laragon.org/download/

4. Run the migrations and seed the database:
    ```sh
    php artisan migrate
    ```

5. Start the development server:
    ```sh
    php artisan serve
    ```

## Usage

This mini project is published for the [Footbal](https://footballi.net/) as the first task i have been assigned.

## Warning
Note that the username you are logging in with should be your giuhub username and in the token field your github Personal Access Token should be inserted

### Accessing the Application

Open your browser and go to `http://localhost:8000` to see the application in action.

### API Endpoints

- `POST /api/v1/syncData`: Store and update all the starred repositories in database.(Auth Needed)

- `POST /api/v1/register`: Register User.
- `POST /api/v1/login`: Login User.
- `POST /api/v1/logout`: Logout user.(Auth Needed)

- `GET  /api/v1/repositories`: Retrieve all replos belong to the user.(Auth Needed)
- `PUT  /api/v1/repositories/{repository}`: Update repository tags.(Auth Needed)
- `GET  /api/v1/repositories/{repository}`: Retrieve a specific repository by ID.(Auth Needed)
- `POST /api/v1/repositoriesSearch`: Unstar repositories.(Auth Needed)

- `GET  /api/v1/tags`: Retrive all tags.(Auth Needed)
- `POST /api/v1/tags`: Store tag.(Auth Needed)
- `GET  /api/v1/tags/{tag}`: Show tag.(Auth Needed)
- `PUT  /api/v1/tags/{tag}`: Update tag.(Auth Needed)
- `DELETE /api/v1/tags/{tag}`: Delete tag.(Auth Needed)
- `GET  /api/v1/tagsSearch`: search among tags.(Auth Needed)

- `GET  /api/v1/tags/{tag}/repositories`: Retrive repos with {tag}.(Auth Needed)

## Testing

To run the tests, use the following command:
```sh
php artisan test
```
