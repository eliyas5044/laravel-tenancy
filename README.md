<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel Tenancy

We want it to be as easy as possible to get started with Laravel. There are a variety of options for developing and running a Laravel project on your own computer. While you may wish to explore these options at a later time, Laravel provides [Sail](https://laravel.com/docs/8.x/sail), a built-in solution for running your Laravel project using [Docker](https://www.docker.com/).

### Get started
1. Visit to the home page and register into application.
2. Go to `/company/create` and create a **Company** (Tenant).
3. Click **Visit** button in companies table to visit Tenancy home page.

We have seeds two base users, **super admin** and **user**.
> Super Admin
```shell
Email: super@admin.com
Password: password
```
> User
```shell
Email: john@doe.com
Password: password
```

We are sending notification to Post author, when an Admin publish any post.
