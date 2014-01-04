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
* Sphinxsearch 2.0.4+

## Setup

1. Install composer dependences: `composer install --dev`.
1. Import MySQL tables using `config/boxmeup_2013-08-05.sql`.
1. Configure sphinx search using `config/sphinx.conf`.
1. Make temporary directories writable by your webserver: `chmod 0777 -R app/tmp`
