#!/usr/bin/env bash

echo "Preparing app."
composer install --dev
chmod 0777 -R app/tmp

docker-compose up -d mysql
echo "Waiting for mysql to be reachable."
sleep 10
cat config/boxmeup_2013-08-05.sql | docker exec -i $(docker-compose ps -q mysql) mysql boxmeup -u boxmeup -pboxmeup

echo "Starting up app."
docker-compose up -d