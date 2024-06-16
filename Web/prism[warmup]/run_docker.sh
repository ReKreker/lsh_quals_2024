#!/bin/bash

IMAGE_NAME="prism"
CONTAINER_NAME="prism"


if ! [ -x "$(command -v docker)" ]; then
  echo 'Error: docker is not installed.' >&2
  exit 1
fi


echo "Building Docker image..."
docker build -t $IMAGE_NAME .


if [ "$(docker ps -q -f name=$CONTAINER_NAME)" ]; then
    echo "Stopping and removing existing container..."
    docker stop $CONTAINER_NAME
    docker rm $CONTAINER_NAME
fi


echo "Running Docker container..."
docker run -d -p 1337:80 --name $CONTAINER_NAME $IMAGE_NAME

echo "Container is running at http://localhost:1337"
