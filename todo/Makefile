up:
	docker-compose up -d
	sleep 10
	symfony console doctrine:migrations:migrate
	symfony console app:create-default-user
	symfony server:stop
	symfony serve -d
	symfony open:local
database:
	symfony console doctrine:database:create
migrations:
	symfony console doctrine:migrations:migrate
down:
	docker-compose down
	symfony server:stop
open:
	symfony open:local
run-spec:
	vendor/bin/phpspec run
describe:
	vendor/bin/phpspec describe