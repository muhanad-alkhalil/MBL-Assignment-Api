# Run the API
Go to the folder application using cd command on your cmd or terminal
Run 
```bash
composer install on your cmd or terminal
```

Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
Open your .env file and change the database name (mbl), username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.

```bash
Run php artisan key:generate
Run php artisan migrate
php artisan db:seed
Run php artisan serve
```
