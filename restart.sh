#!/bin/bash

network_name="multi-tenancy"

# Get all container IDs connected to the network
container_ids=$(docker network inspect $network_name -f '{{range .Containers}}{{.Name}} {{end}}')

# Stop and remove each container
for container in $container_ids; do
  echo "Stopping and removing container: $container"
  docker stop $container
  docker rm -v  $container
done

 # remove data directory
rm -rf ./data

./init.sh