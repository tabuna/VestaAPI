<p align="center">
<a href="https://github.com/TheOrchid/Platform"><img height="120"  src="https://cloud.githubusercontent.com/assets/5102591/25568951/b69285b4-2e15-11e7-9bd1-c91a04fb7f97.png">
</a>
</p>


<p align="center">
Powerful API client hosting VestaCP for Laravel
</p>



## Installation


#### Via Composer

Going your project directory on shell and run this command: 

```sh
$ composer require tabuna/vesta-api
```

Add to `config/app.php`:

Service provider to the 'providers' array:

```php
'providers' => [
    // Laravel Framework Service Providers...
    //...
    
    // Package Service Providers
    VestaAPI\Providers\VestaServiceProvider::class
    
    // ...
    
    // Application Service Providers
    // ...
];
```

Facades aliases to the 'aliases' array:
```php
'aliases' => [
    // ...
    
    'Vesta' => VestaAPI\Facades\Vesta::class,
];
```

Publication
```php
php artisan vendor:publish
```

