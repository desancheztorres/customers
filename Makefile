# To get the current directory in Linux, Mac or Windows
current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))
SHELL = /bin/sh

start:
	@docker-compose up -d

restart: stop start

stop:
	@docker-compose down

rebuild:
	@docker-compose up -d --build

.PHONY: build
build: composer/install

php:
	@docker-compose run --rm php $(command)

composer/install: ACTION=install
composer/update: ACTION=update
composer/require: ACTION=require $(module)
composer composer/install composer/update composer/require:
	@docker-compose run --rm composer $(ACTION)

phpstan:
	@docker run --rm -v $(current-dir):/app ghcr.io/phpstan/phpstan:1-php8.1

