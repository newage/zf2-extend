SHELL=/bin/bash

echo "Begin upload dependencies"
curl -s http://getcomposer.org/installer | php
php composer.phar install

echo "Copy config file for developer tools"
cp vendor/zendframework/zend-developer-tools/config/zenddevelopertools.local.php.dist config/autoload/zdt.local.php

echo 'export PATH=$PATH:'${PWD} >> ~/.bashrc

echo "Install finish successfully!"
