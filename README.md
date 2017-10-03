saas docker
===========

```bash
# run saas docker containers
docker-compose -p saas --project-directory . -f docker/docker-compose.yml up

# migrate
docker exec -i saas_mariadb_1 mysql -u root -ps22s < init.sql

# launch a mysql client
docker exec -it saas_mariadb_1 mysql -u root -ps22s

# api try
curl http://web.saas.docker/users.php?id=1 -d @- -i
cat body/post.txt | curl -X POST http://web.saas.docker/users.php -d @- -i
cat body/put.txt | curl -X PUT http://web.saas.docker/users.php -d @- -i
cat body/delete.txt | curl -X DELETE http://web.saas.docker/users.php -d @- -i
```
