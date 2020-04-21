docker-up: memory
	docker-compose up -d

docker-down:
	docker-compose down

docker-build: memory
	docker-compose up --build -d

assets-install:
	docker-compose exec npm install

memory:
	sudo sysctl -w vm.max_map_count=262144

perm:
	sudo chown ${USER}:${USER} app/storage -R
	if [ -d "node_modules" ]; then sudo chown ${USER}:${USER} node_modules -R; fi