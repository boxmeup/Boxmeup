# About
Boxmeup is a web application designed to organize your containers, boxes, and
other bulk storage items.  Simply create a "container", label it, input items into
the container, and Boxmeup takes care of the rest.

You'll be able to print QR code labels to put onto your containers, which allow
you to scan and pull up a list of items in the container on your phone.  It also
allows you to search all of your containers to find a specific item and Boxmeup
tells you where it is!

## Installation

    git clone git://github.com/cjsaylor/Boxmeup .

## Configure the shell

#### edit your bash rc file:

    vim ~/.bashrc
    alias boxmeup='/path/to/boxmeup/cakephp/cake/console/cake -app /path/to/boxmeup/app'

## Copy configuration files

* app/config/database.php.default -> app/config/database.php
** Enter in your DB credentials
* app/config/core.php.sample -> app/config/core.php

## Configure the database

#### Execute schema create

    boxmeup schema create App

## Configure Sphinx

Comming soon...
