start:
	php artisan serve --host 0.0.0.0

setup:
	composer install
	cp -n .env.example .env
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate:refresh
	php artisan db:seed
	npm ci
	npm run build
	make ide-helper

migrate:
	php artisan migrate

console:
	php artisan tinker

log:
	tail -f storage/logs/laravel.log

test:
	php artisan test

lint:
	composer phpcs

lint-fix:
	composer phpcbf

test-coverage:
	XDEBUG_MODE=coverage php artisan test --coverage-clover build/logs/clover.xml

install:
	composer install

validate:
	composer validate

ci:
	npm ci

build-front:
	npm run build

compose-start-d:
	docker-compose up -d

compose-build:
	docker-compose build

compose-db:
	docker-compose exec db pgsql -U postgres

compose-down:
	docker-compose down -v

ide-helper:
	php artisan ide-helper:eloquent
	php artisan ide-helper:gen
	php artisan ide-helper:meta
	php artisan ide-helper:mod -n
