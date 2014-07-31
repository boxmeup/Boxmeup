Boxmeup
=======

Boxmeup is a web and mobile application to help users keep track of what they have in their containers and how to find items in specific containers.

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/boxmeup/Boxmeup/badges/quality-score.png?b=3.0)](https://scrutinizer-ci.com/g/boxmeup/Boxmeup/?branch=3.0)
[![Huboard](https://img.shields.io/badge/Hu-Board-7965cc.svg)](https://huboard.com/boxmeup/Boxmeup)

# Requirements

* PHP 5.4+
* MySQL 5.5
* Sphinxsearch 2.0+
* Composer
* NodeJS (npm)
* Bower
* Compass
* Grunt CLI

# Quick start

```bash
npm install && bower install && composer install
cp config/environment.dist.php config/environment.php
```

# Build CSS/JS

```bash
grunt build
```

# Debug

To get debug mode:

* For apache: set `DEBUG 1` in `.htaccess`
* For all others, set the environment variable `DEBUG=1` for runtime.
