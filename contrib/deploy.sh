#!/bin/bash
set -ev

if [ "${TRAVIS_PULL_REQUEST}" = "false" ]; then
    npm i -g bower
    bower install
    gem install compass
    ./node_modules/.bin/grunt build
    docker build -q -t cjsaylor/boxmeup .
    docker login -e="$DOCKER_EMAIL" -u="$DOCKER_USERNAME" -p="$DOCKER_PASSWORD"
    docker push cjsaylor/boxmeup
fi
