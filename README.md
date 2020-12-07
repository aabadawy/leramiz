To Start Use This Repo Pleasse Follow the next steps
- Clone The project
- Go to the folder application using cd command on your cmd or terminal
- Run `composer install` on your cmd or terminal
       - Note : if you had this error msg : “Your lock file does not contain a compatible set of packages. Please run composer update.” you have to run `composer install --ignore-platform-reqs`
- copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or `cp .env.example .env` if using terminal, Ubuntu
- Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration. By default, the username is root and you can leave the password field empty. (This is for Xampp) By default, the username is root and password is also root. (This is for Lamp)
- Run php artisan key:generate
- Run php artisan migrate

- Run php artisan cache:clear

- Run php artisan config:clear

- Run php artisan server
