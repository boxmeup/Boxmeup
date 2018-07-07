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

* PHP 7.2+
* Sphinxsearch 2.1.9+

## Setup

1. `cp docker-compose-dev.yml docker-compose.yml`
1. `./bin/setup.sh`

## Search index build

To build the sphinxsearch index, ensure you have the mysql container running and run:

```
./bin/sphinx_index.sh
```
