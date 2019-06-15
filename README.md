aqf
===

A Symfony project created on June 15, 2019, 8:19 am.

Installation Instructions

1. Clone this git repository
2. Install composer and enter all the required parameters (This will also create a parameters.yml file)
3. Provide your correct db username and password in parameters.yml
4. Create the db by running this command within your project folder
`php app/console doctrine:database:create` 
5. Run this command to update your doctrine database schema
`php app/console doctrine:schema:update --force`
6. Run this command to add dummy data user and mission data into the website
`php app/console doctrine:fixtures:load`
7. If you have any permissions with your cache permissions, follow the instructions at https://symfony.com/doc/2.8/setup/file_permissions.html
8. Clear the dev and production cache with the following commands
`php app/console cache:clear --env=dev`
`php app/console cache:clear --env=prod`
