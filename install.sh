SHELL=/bin/bash

echo "Begin upload dependencies"
curl -s http://getcomposer.org/installer | php
php composer.phar install

echo "Copy config file for developer tools"
cp vendor/zendframework/zend-developer-tools/config/zenddevelopertools.local.php.dist config/autoload/zdt.local.php

echo "Copy doctrine config"
cp config/autoload/doctrine.local.php.dist config/autoload/doctrine.local.php

echo "Install finish successfully!"
