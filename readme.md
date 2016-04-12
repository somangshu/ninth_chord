#ninth_chord


The project aims at the basic understanding of angular with laravel in a way to understand the basic restful data flow and front-end templating. The use of repository abstraction layer has been made. read more

Before starting the app take a few notes-:

- After cloning the project do a composer dump-autoload && composer update(this will install all the dependencies)
- Copy all the settings from .env.example and create and copy it to .env(edit the settings if required)
- Create a Database with name specified in env.
- Run command php artisan migrate(this will create all the tables)
- Finally point your subdomain or virtual host to the public folder and you are all set up to go!(an alternate is php artisan serve-> will run the project at localhost:8000)
