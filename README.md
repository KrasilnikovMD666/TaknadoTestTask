Инструкция по развертыванию проекта.

Развертывание проекта на веб-сервере:
1. Необходимо выгрузить проект в корневую папку веб-сервера, я использовал XAMPP, у меня это htdocs.
2. Запустить веб-сервер и MySQL
3. Ввести в командную строку localhost/TaknadoTestTask/index.php

Развертывание проекта в docker:
1. Необходимо запустить Docker
2. В терминале перейти на папку с проектом
3. В командной строке ввести docker-compose up -d
4. Ввести в строку браузера 127.0.0.1:8000
5. phpMyAdmin localhost/8080

База данных подключена в docker, проверить её наличие можно введя команды:
docker-compose exec mysql bash
mysql -uroot -proot
show databases;
имя базы данных company_data
В случае проблем, файл базы данных находится в папке sql и её можно импортировать через phpMyAdmin
1. В своём проекте я использовал phpMyAdmin. Необходимо выбрать "Импорт" в верхней панели
2. Выбрать файл company_data.sql из папки sql и нажать "Импорт"
