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