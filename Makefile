COLOR_RESET   = \033[0m
COLOR_INFO    = \033[32m
COLOR_COMMENT = \033[33m
COLOR_ALERT   = \033[31m
COLOR_BIG_ALERT   = \033[41m

#########################################################
## This is the default task you'll use to start machine #
#########################################################
up:
	docker-compose up --build --abort-on-container-exit

build:
	docker-compose build

#Use this at first run. You should not have to use it again
init: build
	docker-compose run --rm php sh docker/php/init.sh
	docker-compose run --rm node npm install
	docker-compose up

#Use this to load fixtures
fixtures:
	docker-compose run --rm php bin/console doctrine:fixtures:load --quiet

#Install JS dependencies following package-lock.json
npm:
	docker-compose run --rm node npm install

#Install php dependencies up-to-date with the latest composer.lock file
composer:
	docker-compose run --rm php composer install

#Run doctrine migrations
migrations:
	docker-compose run --rm php bin/console doctrine:migrations:migrate --allow-no-migration --quiet

#Use this to open a terminal into the php container
php:
	docker-compose run --rm php bash

#You have weird errors, message about missing classes ? This could be your solution
update: composer npm migrations fixtures
	printf "\n"
	printf "${COLOR_INFO} ✓ ALL DONE ${COLOR_RESET}\n"
