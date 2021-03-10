## Laravel 5.7 + Vue.Js Project

Created test project in laravel framework and vue. This is a simple project that accepts multi threaded comments and replies. 

![image](https://user-images.githubusercontent.com/80142330/110276294-c8febd00-800d-11eb-92ad-91ec4b2c1bd7.png)


## Installation

1. Clone this repository
``` cmd
git clone -b master https://github.com/thesaariola/testProject.git <YOUR DIRECTORY>
```
2. Install Via Composer
``` cmd
composer install
```
3. Generate Application Key
``` cmd
php artisan key:generate
```
4. Modify .env files for database settings
```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dbtest
DB_USERNAME=root
DB_PASSWORD=
```
5. Migrate Database
``` cmd
php artisan migrate
```
6. Add initial entries
``` cmd
php artisan tinker
>>> factory(App\Models\Comment::class,3)->create(['parent_id' => null])
```

![image](https://user-images.githubusercontent.com/80142330/110278763-d4a0b280-8012-11eb-8414-2c60f9ca34b0.png)

7. Install Dependencies
``` cmd
npm install
npm run dev
```


