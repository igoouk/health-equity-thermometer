# health-equity-thermometer

A quiz application.
User verification is via verification e-mail codes. User requests a code to their email, inputs the code again in the page to proceed to the quiz.
Quiz structure based on question types and allowed answers. All data including questions and their options/answers are located in the db. 

# Structure:
* app/Models folder is containing the defined models. These models are controlled via controllers in app/http/controllers
* Any routing, url redirection is controlled by routes/web.php

# Syetem:
Framework: Laravel 8.83.25
PHP: 7.4
Frontend: Blade Templates
Admin template: Black Dashboard

# Requirements:
Composer
npm  (version 16.13.2)   (If using nvm, download the verion and use command "nvm use 16.13.2")

# Local installation:
1)Clone the project to your local
2)In the base project folder, run "composer install"
3)check that .env.local mathces your local setup details. 
4)In the terminal run php artisan key:generate
5)To create the db tables: 
Option 1 : Get the db from staging and import
Option 2 : Migrate db table schema (no data) run "php artisan migrate"
Option 3 : Instead of migrating db schema you can use the sample db sql file within the root folder. 
6)run "npm install"
7)Create a new local domain and add local_project_folder/public as the content folder. Enable ssl
7.a)If you like to use artisan to serve the application by itself on local, type:
php artisan serve
Then open http://localhost:8000/

# Development:
"npm run watch" to watch and compile js and sass changes live

# Production & staging:
Settings can be found in appropiate env files. Server should point the /public folder like local. 
"composer install --optimize-autoloader --no-dev" command should run after each successful push to server.

# Admin/dashboard users:
Application uses Bcrypt algorithm for hashing passwords. If the admin pass is required to be resetted, new one can be generated here: https://bcrypt.online/
Also when creating a new dashboard user, the password can be produced here again. All the details should be created/inserted within the users table in the db. 
