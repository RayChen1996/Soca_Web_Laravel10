### Clone Repo Note
##### 因為Vendor資料夾並不會上傳Git所以要用Composer將庫載下來 (新電腦要裝Composer)
```
composer update
```
## Env
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:N03VbwSwclWwUrYl0l1HG8no7gHqE+XNp59CJPtCoOg=
APP_DEBUG=true
APP_URL=http://soca_web_php82_laravel.test

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=firebird
DB_HOST=127.0.0.1
DB_PORT=3350
# DB_DATABASE=C:\SOCA\DataBase\SOCAWEBDB.FDB
DB_DATABASE=socaweb
DB_USERNAME=sysdba
DB_PASSWORD=23281777


# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=soca_web_php82_laravel
# DB_USERNAME=root
# DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

```

### Start Project 
```
php artisan serve --port=XXXX
```
### 軟體安裝
#### 1.Apache 2.4
#### 2.PHP 8.2.9
#### 3.Laravel 10
#### 4.Firebird fbClient.dll 放到php7.4目錄下 php.ini => extension=php_firebird 取消註解


### Composer 套件
```
"harrygulliford/laravel-firebird": "^3.2", //Firebird Client Lib
"swagger-api/swagger-ui": "^5.4" //Swagger Doc 套件


```


### Apache httpd.Conf (Windows)
```
<VirtualHost *:7791>
    DocumentRoot "C:/WEB_SERVER/Apache3/Apache24/soca/public/www"
    ServerName 127.0.0.1
    AddType application/x-httpd-php .php .html

    # Allow CGI execution
    Options +ExecCGI
     <Directory C:/WEB_SERVER/Apache3/Apache24/soca/public/www>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>


    <Directory "C:/WEB_SERVER/Apache3/Apache24/soca/public/cgi-bin">
        Options +ExecCGI
        AddHandler cgi-script .cgi
        AddType application/x-httpd-php .php .html
        AllowOverride All
        Require all granted
    </Directory>

    ProxyPass "/api" "http://127.0.0.1:7792/api"
    ProxyPassReverse "/api" "http://127.0.0.1:7792/api"
  
    <Directory "C:/WEB_SERVER/Apache3/Apache24/soca/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
 

 


<VirtualHost *:7792>
    DocumentRoot "C:/WEB_SERVER/Apache3/Apache24/soca/public"
    ServerName 127.0.0.1
    AddType application/x-httpd-php .php .html

    # Allow CGI execution
    Options +ExecCGI
    


    <Directory "C:/WEB_SERVER/Apache3/Apache24/soca/public/cgi-bin">
        Options +ExecCGI
        AddHandler cgi-script .cgi
        AddType application/x-httpd-php .php .html
        AllowOverride All
        Require all granted
    </Directory>
  
    <Directory "C:/WEB_SERVER/Apache3/Apache24/soca/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### 其他
```
//產生Swagger Doc 
php artisan l5-swagger:generate


```


### Note
```

1. API 需加入驗證
2. 

```
