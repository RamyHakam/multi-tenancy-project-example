#!/bin/bash

# restart the containers
docker-compose build --no-cache
docker-compose up -d

# Wait for containers to be ready (adjust the sleep time as needed)
sleep 4

# Create tenant hosts list
make create-tenant-host db-port=4444 db-user=test-tenant1 db-password=test-tenant1
make create-tenant-host db-port=5555 db-user=test-tenant2 db-password=test-tenant2
make create-tenant-host db-port=6666 db-user=test-tenant3 db-password=test-tenant3
make create-tenant-host db-port=7777 db-user=test-tenant4 db-password=test-tenant4
make create-tenant-host db-port=8888 db-user=test-tenant5 db-password=test-tenant5