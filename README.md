<p align="center">
<img width="150"  src="https://cloud.githubusercontent.com/assets/5102591/25568951/b69285b4-2e15-11e7-9bd1-c91a04fb7f97.png">
</p>


#
<p align="center">
Powerful API client hosting VestaCP for Laravel
</p>

<p align="center">
<a href="https://codeclimate.com/github/tabuna/VestaAPI"><img src="https://codeclimate.com/github/tabuna/VestaAPI/badges/gpa.svg" /></a>
<a href="https://styleci.io/repos/89877448"><img src="https://styleci.io/repos/89877448/shield?branch=master"/></a>
<a href="https://packagist.org/packages/tabuna/vesta-api"><img src="https://poser.pugx.org/tabuna/vesta-api/v/stable"/></a>
<a href="https://packagist.org/packages/tabuna/vesta-api"><img src="https://poser.pugx.org/tabuna/vesta-api/downloads"/></a>
<a href="https://packagist.org/packages/tabuna/vesta-api"><img src="https://poser.pugx.org/tabuna/vesta-api/license"/></a>
</p>


## Installation


#### Via Composer

Going your project directory on shell and run this command: 

```sh
$ composer require tabuna/vesta-api
```

Publication
```php
php artisan vendor:publish -all
```

Generate api key

```bash
bash /usr/local/vesta/bin/v-generate-api-key
```
Or you can view existing keys

```sh
ls -l /usr/local/vesta/data/keys/
```

## Usage

	
Simple usage
```php
use VestaAPI\Facades\Vesta;

$backups = Vesta::server('testVDS')->setUserName('MyUserName')->listUserBackups($userThatUWantView);

