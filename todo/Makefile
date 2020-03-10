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
	symfony console doctrine:migrations:migrate
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
	vendor/bin/phpspec run --no-coverage --format=pretty
describe:
	vendor/bin/phpspec describe
spec-coverage:
	vendor/bin/phpspec run
phpunit:
	bin/phpunit
test: spec phpunit
clean:
	rm -rf coverage