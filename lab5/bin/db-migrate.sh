#!/bin/bash

docker exec web sh -c "php vendor/bin/doctrine-migrations migrations:migrate --no-interaction"
