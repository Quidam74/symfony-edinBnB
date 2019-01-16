# EdinBnB

## Tuto

Create entity
``` bash
php bin/console make:entity
# Create new migration after each modification of the DB.
php bin/console make:migration
```

Doctrine
``` bash
# Drop database
php bin/console doctrine:database:drop --force
# Create database
php bin/console doctrine:database:create
# Load table in database
php bin/console doctrine:migrations:migrate
```