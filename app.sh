#!/bin/bash

# https://github.com/docker/compose/issues/2380
# export UID of the current user, we use this to create an user inside the container with the same ID
export UID

docker-compose "$@"
