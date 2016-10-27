This builds 3 different setups

docker-compose -f [composefile] build && 
docker-compose -f [composefile] up

should bring each of them up with a working sql connection - all need the `testing` database creating

docker-compose.yml
==================

NGinx + PHP-FPM + MySQL containers

Code gets copied into FPM container

Static files get copied into NGinx container

Any missing files get passed across to PHP - if _think_ urls are restricted to those ending in PHP but that would be easy to change.

Uploads are available in both containers and are help in the `uploads` volume.

MySQL data is held in the `mysqldata` volume

`docker volume inspect <volname>` will tell you the actual location of the files
	
Ie `docker volume inspect uploads`

docker-compose.yml.apache
=========================

Apache/mod_php + MySQL Containers

Code gets copied into Apache container

Uploads are available in uploads folder and held outside the container in the `uploads` volume

MySQL data is held in the the `mysqldata` volume

docker-compose.yml.allinone
===========================

Decidedly less ideal - this is based off the phusion base image

On build it does a full `apt-get upgrade` since the base image is always out of date.

This has Apache, mod_php and MySQL all held together in one container. Output just goes to log files inside the container so those would need to be mounted to be accessible

Apache and MySQL are launched using RunIt at PID 1

Uploads are held in the `uploads` volume
Mysqldata is held in the `mysqldata2` volume - this was because its a different version to the others



