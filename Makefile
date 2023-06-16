init:
	docker-compose build --no-cache && \
	docker-compose up -d

db-init:
	docker compose exec app php artisan migrate:fresh --seed

seed:
	docker compose exec app php artisan db:seed

migrate:
	docker compose exec app php artisan migrate

up:
	docker-compose up -d

down:
	docker-compose down
