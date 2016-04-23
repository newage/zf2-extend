zf2-extend
==========

ZendFramework2 skeleton application + Doctrine2 with BDD (Behat, phpspec) and modern testing tool (codeception)

##Install
###Docker

To build the docker container
```
sudo docker build -t zf2/dev .
```

To run the docker container
```
sudo docker run -d -v <local_path>:/var/www -p 80:80 -p 3306:3306 -p 22:22 --name zf2 -t zf2/dev
```

To connect the docker container
```
sudo docker exec -i -t zf2 bash
```

SSH connect to docker container
```
ssh root@172.17.0.2
password: screencast
```

To get ip address the docker container
```
sudo docker inspect zf2 | grep IPAddress
```


###Install via composer
```
$> composer install
```

##Setup
###Update database in the docker container
```
$> cd /var/www
$> bin/phing
```

##Doctrine

###Validate mappings
```
bin/doctrine-module orm:validate-schema
```

###Generate the database
```
bin/doctrine-module orm:schema-tool:create
```

###Update the database
```
bin/doctrine-module orm:schema-tool:update
```

###Apply fixtures
```
bin/doctrine-module data-fixture:import
```

##MVC Structure

Entity - Provide access to data. Are simple. Data, keep them simple! No logic, just simple checks. Only aware only of themselves + associations.

Mapper - Provide methods for work with DB.

Model - Implement all business logic. Work with mapper.

Service - Create relations between any models and form. 

Controller - Call service and add data to view.