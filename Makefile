db-no:
	docker-compose build --no-cache
db:
	service docker start
	docker-compose build
du:
	service docker start
	docker-compose up -d
de:
	docker-compose exec -u root php bash
due:
	service docker start
	docker-compose up -d
	docker-compose exec -u root php bash
dd:
	docker-compose down