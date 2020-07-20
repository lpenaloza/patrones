#!/usr/bin/env bash
set -ex
if [ ! -d "/app/node_modules" ]
then
    npm install
    npm install gulp
    npm install --global gulp-cli
fi
gulp