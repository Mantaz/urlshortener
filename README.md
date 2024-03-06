# Url Shortener

## Setup process

### Prerequisites.
- PHP
- Composer
- XAMPP


To clone the repository type
```
git clone https://github.com/Mantaz/urlshortener.git
```


### Setup
Install all of the PHP dependencies.
```
composer install
```



Generate an app encryption key.
```
php artisan key:generate
```



Create a database for your project and fill database credentials in the .env file.



Migrate the database.
```
php artisan migrate
```



Install all of the JavaScript dependencies.
```
npm install
```



Compile the project.
```
npm run dev
```



And finally start it
```
php artisan serve
```
