# EdinBnB

## Tuto

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