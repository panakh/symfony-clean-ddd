.PHONY: spec
up: dbup composer-install migrate default-user stop serve open-local
open-local:
	symfony open:local
serve:
	symfony serve -d
stop:
	symfony server:stop
default-user:
	symfony console app:create-default-user
migrate:
	symfony console --no-interaction doctrine:migrations:migrate
composer-install:
	composer install --prefer-dist --no-suggest -o
dbup:
	docker-compose up -d
	sleep 10
database:
	symfony console doctrine:database:create
compose-down:
	docker-compose down
down: compose-down stop
open:
	symfony open:local
spec:
	vendor/bin/phpspec run --no-coverage --format=pretty --ansi
describe:
	vendor/bin/phpspec describe
spec-coverage:
	vendor/bin/phpspec run
unit-coverage:
	bin/phpunit --coverage-html coverage-report
phpunit:dbup migrate default-user
	bin/phpunit
test: spec phpunit compose-down
clean:
	rm -rf coverage
stan:
	docker run -v ${PWD}:/app --rm phpstan/phpstan analyse -l 4 src
symfony:
	curl -sS https://get.symfony.com/cli/installer | bash
	 mv /home/runner/.symfony/bin/symfony /usr/local/bin/symfony