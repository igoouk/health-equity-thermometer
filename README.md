# health-equity-thermometer

A quiz application.
User verification is via verification codes. User requests a code to their email, inputs the code again in the page to proceed to the quiz.
Quiz works mostly on jQuery. All data including questions and their options are located in the db. 

Structure:
* app/Models folder is containing the defined models. These models are controlled via controllers in app/http/controllers
* Any routing, url redirection is controlled by routes/web.php

Framework: Laravel Framework 8.83.25
PHP: 7.4
Frontend: Blade Templates
Admin template: Black Dashboard

Requirements:
Composer
npm

 
Local installation:
1)Clone the project to your local
2)In the base project folder, run "composer install"
3)Copy .env.example file to .env on the root folder. 
4)Open your .env file and change any reqired fields. (Mostly email account for testing purposes)
5)In the terminal run php artisan key:generate

6)To create the db tables: 
Option 1 : Migrate db table schema (no data) run "php artisan migrate"
Option 2 : Instead of migrating db schema you can use the sample db sql file within the root folder. 
7)run "npm install"
8)Create a new local domain and add local_project_folder/public as the content folder. Enable ssl
8.a)If you like to use artisan to serve the application by itself on local, type:
php artisan serve
Then open http://localhost:8000/


Development:
"npm run watch" to watch and compile js and sass changes live

Production & staging:
Settings can be found in appropiate env files. Server should point the /public folder like local. 

