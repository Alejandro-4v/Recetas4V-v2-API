# 4V Chef API

This project is a Symfony-based API for managing recipes, built following the OpenAPI Specification (OAS). It is designed to be run entirely using Docker and managed via `Make` commands for ease of use.

## Project Structure

The project is organized as follows:

- `api/`: Contains the Symfony application source code.
    - `src/`: Application logic (Controllers, Entities, DTOs, Repositories, Commands).
    - `config/`: Configuration files.
    - `migrations/`: Database migration files.
    - `public/`: Public entry point.
- `docker-compose.yaml`: Docker service definitions (PHP and MySQL).
- `Dockerfile`: Configuration for the PHP container.
- `Makefile`: Shortcut commands for common development tasks.
- `4VChef2.yaml`: The OpenAPI Specification (OAS) file defining the API contract.
- `mysql/`: Persistent storage for the MySQL database.

## Prerequisites

- [Docker](https://www.docker.com/) 
- [Make](https://www.gnu.org/software/make/)

## Getting Started

To get the project up and running for the first time, follow these steps:

1. **Start the containers:**
   ```bash
   make up
   ```

2. **Install dependencies:**
   ```bash
   make install
   ```

3. **Run database migrations:**
   ```bash
   make migrate
   ```

4. **Load mock data (optional):**
   ```bash
   make load-mock-data
   ```
   
5. **Start the server:**
   ```bash
   make start
   ```

The API will be available at `http://localhost:8000`.

## Makefile Commands

The following commands are available to manage the project:

### Container Management
- `make up`: Starts the Docker containers in the background using the `api` profile.
- `make down`: Stops and removes the PHP and MySQL containers.
- `make restart`: Restarts all containers.
- `make build`: Rebuilds the PHP Docker image without using the cache.
- `make shell`: Opens an interactive bash shell inside the `php` container.
- `make clean`: Stops containers and removes volumes and local images.

### Application Control
- `make start`: Starts the Symfony internal web server inside the container in daemon mode.
- `make stop`: Stops the Symfony internal web server.
- `make install`: Executes `composer install` inside the container to install PHP dependencies.

### Database & Development
- `make migrate`: Generates a new migration based on entity changes and applies all pending migrations to the database.
- `make load-mock-data`: Executes a custom Symfony command to populate the database with initial mock data.
- `make m-entity`: Shortcut to run the Symfony `make:entity` command interactively.
- `make m-controller`: Shortcut to run the Symfony `make:controller` command interactively.

## OpenAPI Specification

The API is designed based on the `4VChef2.yaml` file located in the root directory. You can use this file to understand the available endpoints, request bodies, and response formats.
