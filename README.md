# Laravel CMS

## How to set up a brand new Laravel 5.8.32, 6.x or 7.x website & install our CMS

```php
// Install Laravel 6.x/7.x & the CMS package
composer create-project --prefer-dist laravel/laravel cms && cd cms && composer require LuizHenriqueBK/LaravelCMS

// Then you need to change the database settings in the .env after that initialize CMS
cd cms & vi .env

php artisan cms:install

npm install && npm run production

```

## Add Middleware

app/Http/Kernel.php

```php
protected $middlewareGroups = [
    'web' => [
        //....
    ],

    'admin' => [
        'auth:admin',
        'acl',
        \RealRashid\SweetAlert\ToSweetAlert::class,
    ],

    'api' => [
        //...
    ],
];

protected $routeMiddleware = [
    'acl' => \App\Http\Middleware\Acl::class,
    //...
];
```

## Add AdminServiceProvider

config/app.php
```php
//...
'providers' => [
    /*
     * Application Service Providers...
     */
    //...
    App\Providers\AdminServiceProvider::class,
    //...
```

## Add guard Admin

config/auth.php

```php
'guards' => [
    'web' => [
        //....
    ],

    'admin' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
        //...
    ],
],

//...

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
        
    //...
],

```
