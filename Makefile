start:
	php artisan serve --host 0.0.0.0

install: setup

setup:
	composer install
	npm ci
	npm run build 
	cp -n .env.example .env
	php artisan key:generate --ansi

test:
	php artisan test

test-coverage:
	php artisan test --coverage-clover=coverage.xml

lint:
	composer exec phpcs -- app routes tests
	
lint-fix:
	composer exec phpcbf -- app routes tests