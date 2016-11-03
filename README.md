FtvenApi project
==========

A Symfony project with FosRestBundle


Install
=======

1)composer install

2)php app/console doctrine:schema:update --force --dump-sql

3)php app/console doctrine:fixtures:load

Use
===
http://YOUR_URL_PATH/blog-api/doc : Api Documentation with sandbox to try services


Activate JWT Authorazition
==========================

The JWT is not activated in the default configuration
to activate it, you just need to uncomment the last 13 lines of the app/config/security.yml

then use POSTMAN to generate a Token wiht a POST request to this url
http://YOUR_URL_PATH/api/login_check

POST /web/api/login_check HTTP/1.1
Host: YOUR_URL_PATH
Cache-Control: no-cache
Postman-Token: 7d185f66-dc37-0a55-1c0f-987c305ea898
Content-Type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW

------WebKitFormBoundary7MA4YWxkTrZu0gW
Content-Disposition: form-data; name="username"

user
------WebKitFormBoundary7MA4YWxkTrZu0gW
Content-Disposition: form-data; name="password"

password
------WebKitFormBoundary7MA4YWxkTrZu0gW--

OR
with Curl

curl -X POST http://YOUR_URL_PATH/web/api/login_check -d username=user -d password=password

and you must put the generated token in the Headers of request
Authorazition Bearer YOUR_TOKEN




Enjoy ;)