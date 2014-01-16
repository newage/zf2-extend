zf2-extend
==========

ZendFramework2 skeleton application + Doctrine2 + other libraries

##Install
Run install file
```
> ./install
```

##Setup
###Apache Virtual host
```
<VirtualHost *:80>
    ServerName zf2-extend
    DocumentRoot /var/www/zf2-extend/public
    DirectoryIndex index.php
    <Directory /var/www/zf2-extend/public>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Order allow,deny
        allow from all
    </Directory>

    Alias /components /var/www/zf2-extend/components
    <Directory /var/www/zf2-extend/components>
        AllowOverride All
        Order allow,deny
        allow from all
    </Directory>

        SetEnv APPLICATION_ENV development
</VirtualHost>
```

##Doctrine

###Validate mappings
```
./vendor/bin/doctrine-module orm:validate-schema
```

###Generate the database
```
./vendor/bin/doctrine-module orm:schema-tool:create
```

###Update the database
Only use on a developer instance.
```
./vendor/bin/doctrine-module orm:schema-tool:update
```

###Apply fixtures
```
./vendor/bin/doctrine-module data-fixture:import
```

##MVC Structure

Entity - Provide access to data. Are simple. Data, keep them simple! No logic, just simple checks. Only aware only of themselves + associations.

Mapper - Provide methods for work with DB.

Model - Implement all business logic. Work with form and mapper and other model.

Controller - Call model and add data to view.