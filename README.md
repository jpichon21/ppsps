# CRIJ - Portail BFC

## Prérequis
* docker
* docker-compose
* php-cs

## Setup
* `cp .env.dist .env.local`
* Adapter le fichier `.env.local`
* `echo "127.0.0.1 ppsps.local" >> /etc/hosts`
* `script/bootstrap`
* `script/start`

## Développement
* Démarrer le serveur `script/start`
* Arrêter le serveur `script/stop`
* Mettre à jour le projet (ex: après un pull) `script/bootstrap`
* Emplacement des logs var/logs

## Production
- ssh as user logomotion
- `sudo su`
- `cd /root/ppsps`
- `docker-compose -f docker-compose.prod.yml up -d`


## Conventions
* Respect des standards Symfony https://symfony.com/doc/4.3/contributing/code/standards.html

## Boîte à outils

### Accès aux conteneurs
Rentrer dans le conteneur php (ex. pour utiliser composer)  
`docker-compose exec php bash`   
`composer update`   
Rentrer dans le conteneur mysql  
`docker-compose exec mysql bash` 

### PhpMyAdmin
L'interface est disponible ici http://localhost:9001    
Login: root    
Mot de passe: mysql    

### Commandes

Exécuter une commande Symfony  
`script/sf <command>`  
(ex: `script/sf cache:clear`)

Exécuter composer
`script/composer <command>`  
(ex: `script/composer install`)

Exécuter le contrôle de qualité du code
`script/cq`  