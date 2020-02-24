<h1 align="center">Globtom assessment</h1>



## Installation Instruction

- Clone the repository to your machine
- open the repo "trello" folder and run "composer install"
- Using any Mysql Client create a database and give it any name of your choice
- go back to the project folder "trello" and then copy .env.example paste it and rename it to .env
  remove .example
- Open .env then change DB_DATABASE=" "   to your the name of the database you created in step 3
- on your terminal navigate to the project, then run "php artisan migrate"
- once the migration process finishes run "php artisan serve"
- goto your web browser the go to http://localhost:8000 or http://127.0.0.1:8000
- the project is also available: on my personal website http://trello.imadecode.co.za
