.PHONY: help install test docker-up

help:
	@echo "Service Mesh Bundle Commands"

install:
	composer install

test:
	vendor/bin/phpunit

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down
