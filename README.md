Boxmeup
=======

Boxmeup is a web and mobile application to help users keep track of what they have in their containers and how to find items in specific containers.

# Requirements

* PHP 5.4+
* MySQL 5.5
* Sphinxsearch 2.0+
* NodeJS (npm)
* Bower
* Compass
* Grunt CLI

# Quick start

```bash
npm install && bower install && composer install
```

# Build CSS/JS

```bash
grunt build
```

# Debug

To get debug mode:

* For apache: set `DEBUG 1` in `.htaccess`
* For all others, set the environment variable `DEBUG=1` for runtime.
