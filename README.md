saas docker
===========

Usage
-----

```bash
# run saas docker containers
docker-compose -p saas --project-directory . -f docker/docker-compose.yml up

# migrate
docker exec -i saas_mariadb_1 mysql -u root -ps22s < init.sql

# launch a mysql client
docker exec -it saas_mariadb_1 mysql -u root -ps22s

# dump database
docker exec -it saas_mariadb_1 mysqldump -u root -ps22s tuts_rest > tuts_rest.sql
```

API usage
---------

```
# get a user
curl http://web.saas.docker/users.php?id=1 -d @- -i

# create a user
cat body/post.txt | curl -X POST http://web.saas.docker/users.php -d @- -i

# modify a user
cat body/put.txt | curl -X PUT http://web.saas.docker/users.php -d @- -i

# delete a user
cat body/delete.txt | curl -X DELETE http://web.saas.docker/users.php -d @- -i
```
