# Requirements

- PHP 8.x
- Composer 2.x
- Docker
- Docker Compose
- [Laravel Sail](https://laravel.com/docs/8.x/installation)

# Getting Started

## Clone repository

Attention the branch to development is **develop**
```
git clone https://github.com/elitedevsquad/imagesource.git
```

## Install Git Hooks

Configure local environment to run pipeline, before push to repository this pipeline run code quality tools and automatic tests to **enable push**

```
sh -c "$(curl -fsSL https://raw.githubusercontent.com/elitedevsquad/devsquad-setup/master/run)"
```

## Setup ENV

Copy .env.example file named with .env

## Install Dependencyes

```
composer update
```
## Generate app key
```
php artisan key:generate
```

## Using [Laravel Sail](https://laravel.com/docs/8.x/installation)

Up sail container
```
sail up
```
Run migrations and seeders
```
sail php artisan migrate:refresh --seed
```
Application is available on [localhost:80](localhost:80)
