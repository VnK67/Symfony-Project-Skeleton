build:
	docker-compose build

init: build
	docker-compose run --rm php sh docker/php/init.sh
	docker-compose run --rm node npm install
	docker-compose up

up:
	docker-compose up --build

fixtures:
	docker-compose run --rm php bin/console doctrine:fixtures:load

php:
	docker-compose run --rm php bash