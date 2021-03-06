### Registration and authorization system in pure PHP and JavaScript

#### Local Setup:
- Setup .env file (copy from .env.example)
- Install package managers:
```bash
composer install
yarn install
```
- Give permissions:
```bash
make perm
```
- Build docker containers:
```bash
make docker-build
make docker-up
```
App available at localhost:8080. Make sure address not already in use.
#### Database:
Import dump:
```bash
docker exec -i auth-test-task_mysql_1 mysql -uroot -psecret app < dump.sql
```
#### Mailer:
Mail configuration available in *.env* file
