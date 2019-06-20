#!/bin/bash

########################
# A very basic script to run this app.
# Prerequisites: .env configured accordingly.
# @R.O.
########################
# Check if composer currently installed
if hash composer; then
  echo "Installing dependencies..."
  composer install
  echo "Generating app key..."
  php artisan key:generate
  echo "Migrating..."
  php artisan migrate
  echo "Seeding..."
  php artisan db:seed
  echo "Serving, with ❤"
  php artisan serve
  exit
fi
