Indent Requisition System
=========================

# Installation

## Run Sentry package migration
	
	$ php artisan migrate --package=cartalyst/sentry

## Run application migration and seed

	$ php artisan migrate --seed

## Create store

	Go to browser and open your application url and login using

	$ user: super, password: pass

	Go to store from the menu and create store

## Import default products and categories with default users

	Import the sql script store1_import.sql at db folder.

## Default Users

	You can start login to application using default users

	1. Store Administrator: ati_store / pass
	2. Store Keeper: ati_store / pass
	3. Indentor: ati_indentor / pass

## Permission

	Login as super user and you need to set user access permissions for pages