# Just  a clean setup

This project is an attempt to work with some of the best packages out there, but without committing to a framework.

My goals:
- create a lean project boilerplate.
- become independent of frameworks.
- make use of packages that:
  - are lean (do not try to do more than we need). 
  - are easy to replace (using standardized interfaces).

Of course this is somewhat inspired by the [frameworkless movement](https://www.frameworklessmovement.org/).

## Development setup
Nginx is used for know with php 8.1.

```bash
docker-compose up
docker-compose exec php composer install
```

## Summary 
These areas are covered so far.

### Configuration
The configuration is built from two php files. The global.php file is for all environments. The local.php file is just for the local enviroment. 

### DI
I only use constructor injection that is provided through factories. Each factory has access to a basic [PSR-11](http://www.php-fig.org/psr/psr-11/) ContainerInterface.

### Autoloading
All autoloading is done by composer.

### EventDispatching
This uses the [Crell/Tukio](https://github.com/Crell/Tukio) component, but by design this [PSR-14](http://www.php-fig.org/psr/psr-14/) implementation kan be easily replaced by another PSR-14 implemetation.

### Middleware
To prevent bloat I made a custom [psr-15](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-15-request-handlers.md) implementation. If you like a challenge, you should try making one yourself. 

### Routing
The implementation uses [FastRoute](https://github.com/nikic/FastRoute) and transforms the matched result into a custom valueobject.

## TODO
This is what needs to be added.

### Cli
This will most likely use the symfony console package. 

### Database
Doctrine2 is still king. It seems a bit bloaty sometimes, but is the most reliable piece of software I have used in the last 10 years.

### InputFilters and Validation
When dealing with incoming data, my choise would be [InputFilter](https://docs.laminas.dev/laminas-inputfilter/) and [Validator](https://docs.laminas.dev/laminas-validator/) from the nice [Laminas people](https://getlaminas.org/). It has little to no requirements and is highly customizable. 

### Templating
Still looking for a templating engine, although I rarely need one (most php projects are api only). Ideally an interface that would allow engine swapping would be great.


