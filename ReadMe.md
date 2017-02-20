# Overview
Simple example RESTful API created with [PHP Silex MVC framework](http://silex.sensiolabs.org/doc/2.0/usage.html) and [Eloquent ORM](https://laravel.com/docs/5.0/eloquent) for database models. City and Neighborhood models use different DBs, ie, City is located in st_cities.cities and Neighborhood is located in st_neighborhoods.neighborhoods.

# Quickstart

## Environment Settings
```
$ export DB001_HOST=<db hostname1> \
DB001_DB=st_cities \
DB001_USER=<db user1> \
DB001_PASS=<db pass1> \
DB002_HOST=<db hostname2> \
DB002_DB=st_neighborhoods \
DB002_USER=<db user2> \
DB002_PASS=<db pass2>
```

## Setup DB
    $ mysql -u <user> -p<pass> -e 'create database st_cities; create database st_neighborhoods;'
    $ mysql -u <user> -p<pass> st_cities < st_cities.cities.sql
    $ mysql -u <user> -p<pass> st_neighborhoods < st_neighborhoods.neighborhoods.sql

## Install Dependencies & Start App
    $ composer install
    $ composer run

## Endpoints
- [http://localhost:8888/](http://localhost:8888/)
- [http://localhost:8888/cities](http://localhost:8888/cities)
    + POST
```
{
    "name":"San Francisco"
}
```
- [http://localhost:8888/cities/1](http://localhost:8888/cities/1)
- [http://localhost:8888/neighborhoods](http://localhost:8888/neighborhoods)
    + POST
```
{
    "city_id": 3,
    "name":"Embarcadaro"
}
```
- [http://localhost:8888/neighborhoods/1](http://localhost:8888/neighborhoods/1)
- [http://localhost:8888/cities/2/neighborhoods](http://localhost:8888/cities/2/neighborhoods)

# Sources
- http://silex.sensiolabs.org/doc/2.0/usage.html
    + http://silex.sensiolabs.org/doc/2.0/cookbook/json_request_body.html
    + http://silex.sensiolabs.org/doc/2.0/usage.html#controllers-as-classes
    + http://blog.adamcameron.me/2015/04/php-silex-controller-providers.html
- https://packagist.org/packages/jguyomard/silex-capsule-eloquent
- http://fideloper.com/laravel-multiple-database-connections
