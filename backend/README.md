# Product Feedback commands hub

```bash
composer init

composer install
# Regenerate the host autoloader
composer dump-autoload

composer validate

composer require --dev phpunit/phpunit # Install dependencies

vendor/bin/phpunit --version # Check deps versions

vendor/bin/phpunit # Run test suite

php public/index.php # Run application

docker compose up -d --build

docker compose build --no-cache php # expose the real Composer error and also rebuild only php

docker compose up -d

docker compose ps

docker compose down

# Then verify PHP has PostgreSQL support
docker compose exec php php -m | grep -E 'pdo_pgsql|pgsql'

# Reinitialize PostgreSQL
docker compose down -v
docker compose up -d

# check db
 docker compose exec postgres \
  psql -U product_feedback -d product_feedback \
  -c '\conninfo'

# Tests with docker 
docker compose exec php vendor/bin/phpunit
```
