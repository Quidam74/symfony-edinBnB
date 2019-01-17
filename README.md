# EdinBnB

## Usage

Install dependencies.
``` bash   
# Symfony dependencies.
composer install
# Npm dependencies
npm install
```

Usage
``` bash
# Run symfony server
php bin/console server:run
# Run gulp (in other terminal)
npm run dev
```

## Helpers

Create entity
``` bash
php bin/console make:entity
# Create new migration after each modification of the DB.
php bin/console doctrine:migrations:diff
# Update database schema
php bin/console doctrine:migrations:migrate
```

Create controller
``` bash
php bin/console make:controller
```

Doctrine
``` bash
# Drop database
php bin/console doctrine:database:drop --force
# Create database
php bin/console doctrine:database:create
# Load table in database
php bin/console doctrine:migrations:migrate
# Load fixtures
php bin/console doctrine:fixtures:load
```

For generate/re-generate entity's accessors
``` bash
php bin/console  make:entity --regenerate
php bin/console cache:clear
```






``` Nous avons mis en place un git Flow, pour éviter d’avoir à gérer des conflits entre nous, pour le moment cela à fonctionner à merveille.

Nous nous sommes organisé de la manière suivante, nous avons pris une grosse matinée pour nous mettre d’accord sur le modèle de donné que nous allions appliquer. Ensuite Alex c’est charger de générer les entités tandis que Florian se penchait sur les fixtures pour générer des jeux de test commun.

Le second jour après que les quelques réglages du modèle est été fini et que les fixtures étaient opérationnels, Alex a commencé à mettre en place son api, il a donc aussi créé un formulaire par entité et générer les repository pour pouvoir accéder à nos données. Pendant ce temps-là, Florian a commencé à mettre en place le contrôler relatif au bien, dans le but de pouvoir faire une première réservation. Nous avons aussi mis en place un Gulp pour compiler nos sources front.$

Ce qui nous porte donc au 3e jour, où dans la mâtiner, nous avons terminé le gros du travail sur l’api et une page produit fonctionnel est présente.
``` 