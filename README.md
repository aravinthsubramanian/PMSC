### Download & install XAMPP Application from follwing link address:

https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.2.12/xampp-windows-x64-8.2.12-0-VS16-installer.exe

### After install XAMPP open it then start Apache and MySQL servers:

### Goto C:\xampp\htdocs folder:

Open C:\xampp\htdocs folder in VsCode Application

### Create project with Laravel^10:

composer create-project laravel/laravel:^10.0 PMSC

--> choose database as MySql
--> remaining config as default
--> Don't run initial migration

### Goto project folder:

cd PMSC

### Copy from all files (if you downloaded from git) into your project folders like:

Otherwise download or clone from https://github.com/aravinthsubramanian/PMSC.git

--> app
--> database/migrations
--> database/seeders
--> public/user
--> public/admin
--> resources/views
--> routes/web

### Comment this line from config/app.php file:

line 59 // 'asset_url' => env('ASSET_URL', '/'),

### Install composer:

composer install

### Modify the .env file:

cp .env.example .env  ((copy [.env.example] content to [.env]))

### Genereate your own artisan key:

php artisan key:generate

### Link storage folder to public:

php artisan storage:link

### Install spatie:

composer require spatie/laravel-permission

### Add service provider manually in config/app.php file:

'providers' => [
    ...

    Spatie\Permission\PermissionServiceProvider::class,
];

### Publish spartie provider globaly:

php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

### Add below content to app/Http/Kernel.php file:

protected $middlewareAliases = [
    ...

    'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
    'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
];

### Update in vendor\spatie\laravel-permission\src\Middleware\PermissionMiddleware.php file:

public function handle($request, Closure $next, $permission, $guard = 'admin')  // Instead of "null" change "admin"
{
    ...
}
public static function using($permission, $guard = 'admin') // Instead of "null" change "admin"
{
    ...
}

### Install JWT for your project:

composer require tymon/jwt-auth

### Add the service provider to config/app.php config file:

'providers' => [
    ...

    Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
]

### Publish JWT provider globaly:

php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

### Generate default Jwt Token:

php artisan jwt:secret

output like below......
(jwt-auth secret [ki85FHwQv4uXFmvhH4VhvSEzOrXs5nCX4d6iuqmaD8qWlotxYI5eGOFe7jRAT95L] set successfully.)

### Mysql config in .env file:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pmsc
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com #(if using gmail)
MAIL_PORT=465
MAIL_USERNAME= your@gmail.com #(email)
MAIL_PASSWORD= your gmail password #(password)
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS= "your@gmail.com" #(same email)
MAIL_FROM_NAME="PMSC"

### Clear the cache:

php artisan optimize 
    (or) 
php artisan config:clear

### Create database for your project:

php artisan migrate

### Insert permissions into database:

php artisan db:seed

### Start your project:

php artisan serve