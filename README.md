<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project

This is a web application build with Laravel framework, focused on backend side and end-to-end encryption approach. If you want to learn more about Laravel Passport and OpenSSL encryption this project maybe useful to you for researching and learning. In this project was implemented of some Laravel modules, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- Multiple back-ends for [session](https://laravel.com/docs/session).
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).
- Laravel Passport as API middleware.
- Laravel Notification with SocketIO integration.
- Laravel Socialite to implement simple google OAuth Register / Login.


If you interest with some feature with this project let's clone it then, explore all code inside, modify as you need to build new robust applications.

## How to start this package

Required Package:
- Laravel Echo Server
- Google Credential API, set in you Google Console Account
- Redis CLI
- PHP Extensions OpenSSL

If all required package is ready, Let's start and follow below steps:
First do clone / download as zip.

Open terminal, then type:
- cd path/to_you_dir
- composer install
- npm install
- php artisan generate:key
- php artisan migrate
- php artisan passport:install --uuids

.ENV setup

copy

- ClientID to PASSPORT_PERSONAL_ACCESS_CLIENT_ID
- ClientSecret to PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET
- GrantClientID to PASSPORT_PASSWORD_GRANT_CLIENT_ID
- GrantSecret to PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET

also fill your google credential :

- GOOGLE_CLIENT_ID=
- GOOGLE_CLIENT_SECRET=
- GOOGLE_OAUTH_CALLBACK=http://localhost:8000/auth/google/callback

don't forget set you OpenSSL credential :

- OPENSSL_AES_METHOD_JS=AES-256-CBC
- OPENSSL_AES_METHOD=AES-128-CBC
- OPENSSL_SECRET_KEY=59b6ab46d379b89d794c87b74a511fbd59b6ab46d379b89d794c87b74a511fbd(hexa-code)
- OPENSSL_SECRET_IV=0aaff094b6dc29742cc98a4bac8bc8f9(hexa-code)

next back to terminal then type:

- php artisan passport:keys --force
- npm run prod
- laravel-echo-server start
- php artisan serve

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Security Vulnerabilities

This project is for educational purpose maybe has some bugs on it, if you found and fixing on it
leave the author message to revise the code.

But,
If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

Same as Laravel framework licensed under the [MIT license](https://opensource.org/licenses/MIT).
