#!/bin/bash

docker compose up -d

composer install

docker exec -w /var/www/html/web app /bin/sh -c "php test.php"

printf "\n"