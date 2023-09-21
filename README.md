# TcivsTopic

# Video Demo
https://youtu.be/K1pzrj-a2VA

# Dev Environment Config
- Apache/2.4.53 (Win64) OpenSSL/1.1.1n PHP/8.1.5  
- 資料庫用戶端版本： libmysql - mysqlnd 8.1.5  
- PHP 擴充套件
  - mysqli
  - curl 
  - mbstring  
- PHP 8.1.5  
- Composer 2.0.7
- phpMyAdmin 5.1.3  
- Laravel 9.9  
  - Laravel Websockets
  - Laravel-Echo 
- GSAP 3.10.4
- Bootstrap 5.0.2
- CKEditor 5
  - CKEditor5-image-remove-event-callback-plugin
# Dev Environment Setup
###### You must first ensure that Node.js and NPM are installed on your machine

1.Install Dependencies
```
npm install
```
```
composer install
```

2.Running Migrations
```
php artisan migrate
```

3.Watching Assets For Changes
```
npm run watch
```

4.Serving Laravel
```
php artisan serve
```
5.Starting Websocket Server
```
php artisan websockets:serve
```
6.To access asset.
```
php artisan storage:link
```
