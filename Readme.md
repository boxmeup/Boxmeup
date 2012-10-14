# About
Boxmeup is a web application designed to organize your containers, boxes, and
other bulk storage items.  Simply create a "container", label it, input items into
the container, and Boxmeup takes care of the rest.

You'll be able to print QR code labels to put onto your containers, which allow
you to scan and pull up a list of items in the container on your phone.  It also
allows you to search all of your containers to find a specific item and Boxmeup
tells you where it is!

# Development

## Requirements

* PHP 5.3+
* Sphinxsearch 0.99+

## Setup

1. Configure sphinx search using `app/config/sphinx.conf`
1. Copy application configuration distribution files:
    * `app/Config/bootstrap.php`
    * `app/Config/core.php`
    * `app/Config/database.php`
1. Make temporary directories writable by your webserver

# Build

1. Place production configuration files in `config/`
2. Run `./bin/build.sh` from root application directory.