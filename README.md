# Coding Practice

## Overview

Php script that loads relational data from tab delimited files, and returns some queries against the loaded data.

## Docker

Docker provides a portable and predictable build environment for thie Php script.  It provides Php 7.1.10 with Sqlite and Composer.

## Composer

Although this library does not require any external dependencies to run, Composer is still used for it's standard PSR-4 compliant autoloader.  It also is used to install phpunit.

## Sqlite

The included data files are small enough where the answers could be derived quickly without an external database.  Sqlite is included as an in-memory database becuse it makes the intent of the code more clear and concise. 

## Running 

### with Docker

```sh
# Build base image
docker build --rm --tag local .

# Run unit tests
docker run local php vendor/bin/phpunit --configuration tests/phpunit.config.xml

# Run program
docker run local
```

## Running

### without Docker

Provided that you've already got Php 7 and Sqlite installed, you can run this package without Docker.

```sh
# Build
php composer.phar install

# Run tests
run local php vendor/bin/phpunit --configuration tests/phpunit.config.xml

# Run script
php index.php
```

## TLDR

Given the checked in data files, this program will output the following.

```
$ docker run local


What category has the highest average sales price? (Please include the average sale price)?
Category: Frozen Foods
Price: 97.61760473


What is the minimum and maximum sale in the category 'Breakfast'?
Min: 5.706340914
Max: 97.71513391
```