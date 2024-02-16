<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Description

This is a simple project example of some of the features that can be used in a Laravel application. This project allows us
to create a series informing its seasons, episodes quantities and use the Eloquent relationship to relate them.
It also has some examples of how to dispatch email for a bunch of users and queue them, using laravel database to store it,
and make some cool examples of automated tests 

## Installation

To install and run this project on your local environment, you must have docker installed, clone this repository and run the following commands.

```bash
$ docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

```bash
$ duplicate the .env_example file and name it .env
```

## Creating an alias for sail

```bash
$ alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

## Running migrations

If you are going to make use of the code for something beside the tests, you should run the migrations, to create all the base tables you need, plus books table inside your mysql

```bash
$ sail artisan migrate
```

## Running the container

```bash
$ sail up
```

## Running tests
```bash
$ sail art test
```

## Stopping the container

```bash
$ sail down
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).