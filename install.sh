SHELL=/bin/bash

echo "Begin upload dependencies"
curl -s http://getcomposer.org/installer | php
php composer.phar install

echo "Begin setup project"
if [ ! -d "data" ]; then
    mkdir --mode=0777 data
fi

cd data

if [ ! -d "cache" ]; then
    mkdir --mode=0777 cache
fi

if [ ! -d "logs" ]; then
    mkdir --mode=0777 logs
fi

if [ ! -d "docs" ]; then
    mkdir --mode=0777 docs
fi

if [ ! -d "indexes" ]; then
    mkdir --mode=0777 indexes
fi

if [ ! -d "tmp" ]; then
    mkdir --mode=0777 tmp
fi

if [ ! -d "upload" ]; then
    mkdir --mode=0777 upload
fi

cd ../application/configs

if [ ! -f "application.development.ini" ]; then
    cp application.development.ini.dist application.development.ini
fi

cd ../../

function zfsetup {
    TFILE=".zf.ini"
    echo "php.include_path = \"${PWD}/vendor/zend/zf1/library\"" > $TFILE
    echo 'export PATH=$PATH:'${PWD} >> ~/.bashrc
}

function setupmanifest {
    ./zf enable config.manifest Manifest
}

if [ ! -f "${PWD}/.zf.ini" ]; then
    echo "Setup zf tool"
    zfsetup
    echo "Create new config file"
    setupmanifest
    echo "Enable Manifest"
fi

echo "Install finish successfully!"
