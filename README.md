saas docker
===========

```bash
# run saas docker containers
docker-compose -p saas --project-directory . -f docker/docker-compose.yml up

# migrate
docker exec -i saas_mariadb_1 mysql -u root -ps22s < init.sql

# launch a mysql client
docker exec -it saas_mariadb_1 mysql -u root -ps22s
```
