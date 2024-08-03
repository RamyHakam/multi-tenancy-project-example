## System commands List

# Initialize the Host and Tenant containers
system-start:
	# This command initializes the system by running the init.sh script.
	# It sets up both the host and tenant containers.
	./init.sh

system-restart:
	# This command restarts the system by running the restart.sh script.
	# It stops and then starts the host and tenant containers to refresh the environment.
	./restart.sh

system-stop:
	# This command stops the system by running the stop.sh script.
	# It halts both the host and tenant containers.
	./stop.sh

# Define default values
db-port ?= 5433
db-user ?= user
db-password ?= password
COMPOSE_FILE ?= docker-compose-tenant-db.yml

# Create and remove tenant hosts
create-tenant-host:
	# This command creates a new tenant database container using the specified port, username, and password.
	# It copies a template Docker Compose file, substitutes the placeholders with the actual values,
	# and starts the container.
	@echo "Creating a new database container with the following details:"
	@echo "Port: $(db-port)"
	@echo "Username: $(db-user)"
	@echo "Password: $(db-password)"
	@cp docker-compose-tenant-db-template.yml $(COMPOSE_FILE)
	@sed -i '' 's/\$${DB_PORT}/$(db-port)/' "$(COMPOSE_FILE)"
	@sed -i '' 's/\$${POSTGRES_USER}/$(db-user)/' "$(COMPOSE_FILE)"
	@sed -i '' 's/\$${POSTGRES_PASSWORD}/$(db-password)/' "$(COMPOSE_FILE)"
	@docker-compose -f "$(COMPOSE_FILE)" -p db$(db-port) up -d
	@rm "$(COMPOSE_FILE)"

remove-tenant-host:
	# This command removes a tenant database container running on the specified port.
	# It stops and removes the container using the provided Docker Compose file.
	@echo "Removing database container on port $(db-port)"
	@docker-compose -f "$(COMPOSE_FILE)" -p db$(db-port) down

# Doctrine commands for the tenant database
tenant-create:
	# This command creates the tenant database schema by executing the t:d:c (tenant:database:create)
	# command inside the php-server container.
	@docker-compose exec php-server bin/console t:d:c

tenant-diff:
	# This command generates a migration file with the changes in the tenant database schema
	# by executing the t:m:d (tenant:migration:diff) command inside the php-server container.
	@docker-compose exec php-server bin/console t:m:d

tenant-migrate-init:
	# This command initializes the tenant database migrations by executing the t:m:m init
	# (tenant:migration:migrate init) command with no interaction inside the php-server container.
	@docker-compose exec php-server bin/console t:m:m init --no-interaction

tenant-migrate:
	# This command applies pending migrations to the tenant database by executing the t:m:m migrate
	# (tenant:migration:migrate) command with no interaction inside the php-server container.
	@docker-compose exec php-server bin/console t:m:m migrate --no-interaction

# Doctrine commands for the main database
main-create:
	# This command creates the main database schema by executing the d:d:c (doctrine:database:create)
	# command inside the php-server container.
	@docker-compose exec php-server bin/console d:d:c

main-diff:
	# This command generates a migration file with the changes in the main database schema
	# by executing the d:m:diff (doctrine:migrations:diff) command inside the php-server container.
	@docker-compose exec php-server bin/console d:m:diff

main-fixtures:
	# This command loads fixtures into the main database by executing the d:f:l (doctrine:fixtures:load)
	# command inside the php-server container.
	@docker-compose exec php-server bin/console d:f:l

main-migrate:
	# This command applies pending migrations to the main database by executing the d:m:m
	# (doctrine:migrations:migrate) command inside the php-server container.
	@docker-compose exec php-server bin/console d:m:m

main-migrate-rollback:
	# This command rolls back the last applied migration in the main database by executing the
	# doctrine:migrations:rollback command inside the php-server container.
	@docker-compose exec php-server bin/console doctrine:migrations:rollback
