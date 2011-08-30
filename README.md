# Bucket-App

A self-hosted, web based envelop budgeting app written in Kohana. It's in heavy development. Don't use it for real life work.

## Install

To install, setup a new virtual host in your webserver and clone this repo (make sure to use --recursive!). Then run `./minion migrations:run`

This will give you an `client id` and `client_secret` and you will need to install into `modules/bucket-application/config/oauth2.php`.

## Tests

To run the unit tests (please do), simply run `ant phpunit`.