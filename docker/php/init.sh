#!/usr/bin/env bash

echo -e "\033[36m############################\033[0m"
echo -e "\033[36m Initializing \033[0m"
echo -e "\033[36m############################\033[0m"

echo -e '\033[42;30mInstalling symfony dependencies ...\033[0m'
composer install --prefer-dist

echo -e '\033[42;30mClearing cache ...\033[0m'
rm -rf var/cache/*

echo -e '\033[42;30mCreating default directories...\033[0m'
mkdir -p ./var/sessions ./var/uploads

echo -e '\033[42;30mChanging owning rights on some folders...\033[0m'
chmod -R 777 ./var/cache ./var/logs ./var/indexes ./var/sessions ./var/uploads ./vendor

echo -e '\033[42;30mInstalling fresh data ...\033[0m'
php ./bin/console doctrine:database:drop --force
php ./bin/console doctrine:database:create
php ./bin/console doctrine:migrations:migrate --allow-no-migration --quiet
php ./bin/console doctrine:fixtures:load --quiet

echo -e '\033[42;30mClearing cache ...\033[0m'
rm -rf var/cache/*
