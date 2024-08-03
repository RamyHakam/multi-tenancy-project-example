network_name="multi-tenancy"

container_ids=$(docker network inspect $network_name -f '{{range .Containers}}{{.Name}} {{end}}')

# Stop and remove each container
for container in $container_ids; do
  echo "Stopping container: $container"
  docker stop $container
done