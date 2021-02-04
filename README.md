Urchomienie projektu
------------
```bash
$ git clone https://github.com/mdepczyk/contact-form.git
$ cd contact-form/
$ docker-compose up -d
```
Założenia
---------
Aplikacja jest podzielona na frontend i backend (REST API). 
Rozwiązanie skupia się na części backendowej, frontend jest możliwie jak najprostszy by tylko umożliwić wysłanie requestu (Twig - zamiast Vue/Reacta/Angulara).
Frontend i backend osobno walidują formularz.

Formularz
---------
[http://localhost:8000](http://localhost:8000)

Dokumentacja API
----------------
[http://localhost:8003](http://localhost:8003)

RabbitMQ Management
------
[http://localhost:15672](http://localhost:15672)
- login: symfony
- password: symfony

Mailhog
-------
[http://localhost:8002](http://localhost:8002)

Odpalenie consumera
-------------------
Dla nowych wiadomości:
```bash
$  docker-compose run php-fpm bin/console messenger:consume send
```
Dla wiadomości których nie udało się wysłać:
```bash
$  docker-compose run php-fpm bin/console messenger:consume send_retry
```

Pozostałe
---------
- CodeSniffer:
```bash
$  docker-compose run php-fpm ./vendor/bin/phpcs -p
```
- PhpStan:
```bash
$  docker-compose run php-fpm ./vendor/bin/phpstan analyse src
```
- Testy:
```bash
$ docker-compose run php-fpm ./vendor/bin/behat
```
