# TcivsTopic



# Dev Environment Config
- Apache/2.4.53 (Win64) OpenSSL/1.1.1n PHP/8.1.5  
- 資料庫用戶端版本： libmysql - mysqlnd 8.1.5  
- PHP 擴充套件
  - mysqli
  - curl 
  - mbstring  
- PHP 8.1.5  
- phpMyAdmin 5.1.3  
- Laravel 9.9  

# Dev Environment Setup
###### You must first ensure that Node.js and NPM are installed on your machine

1.Install Dependencies
```
npm install
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
