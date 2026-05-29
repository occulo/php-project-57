start:
	php artisan serve --host 0.0.0.0

install: setup

setup:
	composer install
	cp -n .env.example .env
	php artisan key:generate --ansi
	npm ci
	npm run build
	touch database/database.sqlite
	php artisan migrate --force --seed

test:
	php artisan test

test-coverage:
	php artisan test --coverage-clover=coverage.xml

lint:
	composer exec phpcs -- app routes tests
	
lint-fix:
	composer exec phpcbf -- app routes tests