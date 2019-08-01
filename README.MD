# Building an api using Symfony / API Platform

## Requirements
* MySQL
* PHP >= 7.2
* Composer

## Installation
1. git clone https://github.com/aythanztdev/prbtcnccl.git
2. cd prbtcnccl
3. Set your datababase credentials in .env
4. composer install
5. php bin/console doctrine:migrations:migrate
6. php bin/console server:run

## Actions
* Category
    * Create category in /api/category (POST)
    * Edit category in /api/category (PUT)
    * Delete category in /api/category (DELETE)

* Product
    * Create product in /api/product (POST)
    * Get products in /api/products (GET)
    * Get featured products in /api/products/featured (GET). In this case, you can add ?currency=EUR or ?currency=USD for getting products with price converted

## Additional info
If you check data directory, you will have a mysql dump with example data. You have a postman json for using it if you want to make actions.
