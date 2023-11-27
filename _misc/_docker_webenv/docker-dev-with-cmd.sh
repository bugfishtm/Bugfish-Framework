#!/bin/bash
# Script to init this docker dev environment and run a command after that
# Inside the new created container
docker compose -f ./docker-dev.yml up -d software

# Define the name of the Docker container you want to wait for
CONTAINER_NAME=SETCONTAINERNAME

# Function to check if the container is running
check_container_running() {
    docker ps -a --format "{{.Names}}" | grep -i "$CONTAINER_NAME" > /dev/null
    return $?
}

# Wait for the container to start
while ! check_container_running; do
    echo "Waiting for container '$CONTAINER_NAME' to start..."
    sleep 5
done

# Container is running, execute the command
echo "Container '$CONTAINER_NAME' is running, executing the command..."
# docker exec -it "$CONTAINER_NAME" YOURCOMMAND
# docker exec -it "$CONTAINER_NAME" YOURCOMMAND
# docker exec -it "$CONTAINER_NAME" YOURCOMMAND
# docker exec -it "$CONTAINER_NAME" YOURCOMMAND
# docker exec -it "$CONTAINER_NAME" YOURCOMMAND
# docker exec -it "$CONTAINER_NAME" YOURCOMMAND
# docker exec -it "$CONTAINER_NAME" YOURCOMMAND

# Pause (you can remove this if not needed)
read -p "Press Enter to exit..."
