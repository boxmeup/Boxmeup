#!/usr/bin/env bash

docker-compose exec -T sphinx bash -c "indexer container_items --rotate"