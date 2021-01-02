# symfony-mysql-nginx-api

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
