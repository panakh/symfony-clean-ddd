up:
	docker-compose up -d
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
