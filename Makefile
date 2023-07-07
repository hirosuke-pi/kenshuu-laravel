init:
	docker-compose build --no-cache && \
	docker-compose up -d

init-db:
	docker compose exec app php artisan migrate:fresh --seed

seed:
	docker compose exec app php artisan db:seed

migrate:
	docker compose exec app php artisan migrate

bash:
	docker compose exec app bash

clear:
	docker compose exec app composer dump-autoload
	docker compose exec app php artisan clear-compiled
	docker compose exec app php artisan optimize
	docker compose exec app php artisan config:cache

db:
	docker compose exec db mysql -u root -p laravel

up:
	docker-compose up -d

down:
	docker-compose down
