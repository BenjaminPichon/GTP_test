# GTP_test
pour lancer le projet :
- cd GTP_test
- mettre les bonnes information pour que le .env puisse se connecter à phpmyadmin
- composer install
- php bin/console doctrine:database:create
- php bin/console make:migration
- php bin/console doctrine:make:migration
- symfony server:start
