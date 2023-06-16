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

db:
	docker compose exec db mysql -u root -p laravel

up:
	docker-compose up -d

down:
	docker-compose down
