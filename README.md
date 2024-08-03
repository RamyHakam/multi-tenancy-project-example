# Multi-Tenancy Project Example

This repository provides a simple example of using the [Multi Tenancy Bundle](https://github.com/RamyHakam/multi_tenancy_bundle) for Symfony applications. The bundle facilitates adding multi-tenancy support to your Symfony project.

## Features

- **Switch DB on Runtime**: Easily switch to any tenant database, managing tenant entities, migrations, and fixtures independently from the main database.
- **Auto Create Bulk DBs with Cron**: Automatically build new tenant databases on any host and prepare them for use.
- **Extended Doctrine Commands**: Manage tenant databases with extended Doctrine commands, similar to single database applications.
- **Docker-Based**: Use simple Docker commands to run and restart the system, ensuring a complete setup for both main and tenant databases.
- **Make Commands for Docker**: Easily run commands inside Docker containers for tenant migration or creation.
- **UI Example for Tenant Management**: Manage tenant entities via UI, adding data to any tenant database and creating new tenant databases with the UI.

## How to Use This Example

1. **Clone the repository:**
   ```bash
   git clone https://github.com/RamyHakam/multi-tenancy-project-example.git
   cd multi-tenancy-project-example
   ```

2. **Install Docker and Docker Compose:**
    - [Docker](https://docs.docker.com/get-docker/)
    - [Docker Compose](https://docs.docker.com/compose/install/)

3. **Run the project:**
   ```bash
   make system-start
   ```

4. **In 2-5 minutes, the system starts and a cron job creates the tenant databases:**
    - The system will pull the images and start the containers.
    - The system will create the main database.
    - The system will run migrations for the main database.
    - The system will run fixtures for the main database.
    - The system will create the tenant hosts.
    - The system will create tenant databases with tenant user credentials.
    - The system will run migrations for the tenant databases.

5. **The project will be running with the following services:**
    - **Main Database**: `postgresql://admin:admin123@localhost:5432/multi_tenancy`
    - **List of Tenants:**
        - **Tenant Host 1**: `postgresql://test-tenant1:test-tenant1@localhost:4444`
        - **Tenant Host 2**: `postgresql://test-tenant2:test-tenant2@localhost:5555`
        - **Tenant Host 3**: `postgresql://test-tenant3:test-tenant3@localhost:6666`
        - **Tenant Host 4**: `postgresql://test-tenant4:test-tenant4@localhost:7777`
        - **Tenant Host 5**: `postgresql://test-tenant5:test-tenant5@localhost:8888`
    - Each Tenant Host has 10 tenant databases, allowing easy switching between them.
    - Each Tenant Database is associated with a tenant user, enabling management of tenant databases with tenant user credentials.
    - A default cron job checks for new tenant databases and creates them automatically.

6. **Make Commands:**

    - **System Commands:**
        - **Start System**: `make system-start` - Initializes all containers and volumes.
        - **Stop System**: `make system-stop` - Stops all containers.
        - **Restart System**: `make system-restart` - Removes all containers and volumes and starts the system again.

    - **Main Database Commands:**
        - **Create Main DB**: `make main-create`
        - **Run Main Migrations**: `make main-migrate`
        - **Run Main Diff**: `make main-diff`
        - **Run Main Fixtures**: `make main-fixtures`

    - **Tenant Database Commands:**
        - **Create Tenant Host**: `make create-tenant-host`
            - Example: `make create-tenant-host db-port=5050 db-user=tenant-example db-password=tenant-example`
        - **Remove Tenant Host**: `make remove-tenant-host`
            - Example: `make remove-tenant-host db-port=5050`
        - **Create Tenant DB**: `make tenant-create`
        - **Tenant DB Diff**: `make tenant-diff`
        - **Tenant Migrations Init**: `make tenant-migrate-init` - Executes the migration init command inside the tenant container.
        - **Tenant Migrations Update**: `make tenant-migrate` - Executes the migration update command inside the tenant container.

7. **Open the project in your browser:** [http://localhost:80](http://localhost:80)

    - You will see the main page with a list of features.
      <img width="1226" alt="Screenshot 2024-08-03 at 21 35 36" src="https://github.com/user-attachments/assets/92d6b7d5-6e61-4a13-9efc-5a5125ec0dfe">


    - You can manage tenant entities and create new tenant databases.
      <img width="1271" alt="Screenshot 2024-08-03 at 19 42 03" src="https://github.com/user-attachments/assets/9285176b-8c6a-4275-8d63-3b3b7633bb46">


    - You can add a Store Category to any tenant database and verify that the data is saved in the tenant database.
      <img width="1226" alt="Screenshot 2024-08-03 at 21 33 17" src="https://github.com/user-attachments/assets/ecc8bc90-2d12-4341-a615-44b6acf6aeaa">

      

## Notes and Considerations

1. The project utilizes the Multi Tenancy Bundle, which provides an easy way to add multi-tenancy support to Symfony applications.
2. Docker and Docker Compose are used to run the system and manage containers.
3. A cron job is set up to automatically create new tenant databases.
4. Make commands are employed to run the system and manage both the main and tenant databases.
5. A simple UI is provided to manage tenant entities and create new tenant databases.
6. An example Store Category entity is included to demonstrate the multi-tenancy support.
7. All tenant databases share the same `dbusername` and `dbpassword` from the selected tenant host.
8. All tenant databases use the `pdo_pgsql` driver.
9. Different drivers can be used for the main and tenant databases, but the same driver must be used for all tenant databases.

## Contributing

Contributions are welcome! If you have any suggestions, improvements, or bug fixes, please feel free to submit a pull request or open an issue.

## Author

Created by [Ramy Hakam](https://github.com/RamyHakam). You can connect with me on [LinkedIn](https://www.linkedin.com/in/ramyhakam/).
