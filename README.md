# symfony-mysql-nginx-api

# ТЗ:
Написать RESTfull API, для сервиса который позволяет авторизироваться пользователю и получать данные о пользователях.
Необходимые запросы:
1) Регистрация пользователя (обязательные поля: (firstname, lastname, nickname, email, age, password)
2) Авторизиция (по полям nickname, password)
3) Получение пользователей по списку emails или nicknames
   пример:
   список emails (test_email@gmail.com, test_email1@gmail.com, test_email2@gmail.com, test_email3@gmail.com)
   или список nicknames (nickname, nickname1, nickname2, nickname3)
   пример запроса:
   {
   ...
   "type" : "email",
   "list" : [
   "test_email@gmail.com",
   "test_email1@gmail.com",
   "test_email2@gmail.com",
   "test_email3@gmail.com"
   ]
   ...
   }
   (и получаем 4 пользователя которых находим по списку email)

4) Получение пользователя по id

обязательные условия:
- Использовать архитектурный подход REST.
- Проект должен быть написан на нативном PHP (версия 7.1 - 8) или с использыванием фреймворка Symfony (версия 2.6 - 5)

Не обязательные условия: (будет плюсом)
- Сделать проект в docker
- Подключить composer + autoload классов
- Придерживаться PSR-(1,2,4)
- использовать паттерны проектирования
- проект выгрузить на свой git и прислать ссылку на проект
- предоставить документацию к проекту



docker-compose up -d --build

docker exec -it php74-container bash 
    -- php bin/console doctrine:database:create
    -- php bin/console doctrine:schema:create

docker exec -it mysql8-container bash 
    -- mysql -uroot -psecret
    -- show databases;
    -- quit
    -- exit



Регистрация 

curl --location --request POST "http://localhost:8080/registration"  --header "Content-Type: application/x-www-form-urlencoded"  --data "nickname=login&password=loginloginlogin&firstname=test&lastname=test&age=32&email=login@gmail.com"

{"code":200,"content":"Зареєстровано успішно. Тепер можете увійти!"}

Авторизація

curl --location --request POST "http://localhost:8080/login"  --header "Content-Type: application/x-www-form-urlencoded"  --data "nickname=login&password=loginloginlogin"

{"code":200,"content":{"token":"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoibG9naW4iLCJleHAiOjE2MDk2MDI0Nzl9.ApgJRz7F_YAnElxoNMVLE6azhOa1NaOBPk9ugDGMF6M"}}

Список користувачів за параметром email/nickname

curl -L -X GET 'http://localhost:8080/api/users/list?params=email' -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoiYWRkX3Rlc3RfcG9zdG1hbl84MTgiLCJleHAiOjE2MDk2MDQzNDF9.cfqCVCeE4Cc31sPQe25ezVSnlzZoSS-Df8NvA5Zmw7A'

{"code":200,"content":{"type":"email","list":["login@gmail.com","ddd13@gmail.com","ddd1@gmail.com"]}}

Перегляд інформації про користувача  за id

curl -L -X GET 'http://localhost:8080/api/users/2' -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoiYWRkX3Rlc3RfcG9zdG1hbl84MTgiLCJleHAiOjE2MDk2MDQ3NTZ9.ASV75BSmN8Y5iU6G7HAgdFYktW8-GV5rR-m_x7f5JLc'

{"code":200,"content":{"id":2,"firstname":"test","lastname":"test","email":"ddd13@gmail.com","nickname":"add_test_3postman_818","age":32,"created_date":"02.01.2021 17:52"}}