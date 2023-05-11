#!/bin/sh
cd /var/www/ 
chmod 777 var
if ! [ -d /var/www/var/db ]
then
    mkdir /var/www/var/db
fi

chmod 777 var/db


if ! [ -e /var/www/var/db/data.db ]
then
    mkdir /var/www/migrations                    
    php bin/console make:migration
    php bin/console doctrine:migrations:migrate --no-interaction
    chmod 666  /var/www/var/db/data.db
fi

symfony server:start