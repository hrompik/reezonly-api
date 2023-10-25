Сделано на yii2 basic по минимому в рамках ТЗ
advanced наверное лучше подошёл бы разделяя не на модули, а изначально на приложения клиентскую и админскую части с двумя точками входа, а уже там модули
И там php init конфигов нормальный. Тут же нужно добавить params-local.php + main-local.php в игнор git и там прописывать логины/пароли/токены 
В целом несколько способов может быть по роутингу и ограничения доступа к экшенам. И с лихвой хватает функционала встроенных экшенов

php 8.1
mysql 8.0
nginx+apache

Установка
git clone https://github.com/hrompik/reezonly-api.git
Переходим в папку
composer i
Определяем точку входа в [/web/index.php](web%2Findex.php) у меня как http://reezonly-api

Создаем базу данных
reezonly и тестовую reezonly_test
login pass reezonly
Ну либо другие, и корректируем конфиг [db.php](config%2Fdb.php) [test_db.php](config%2Ftest_db.php)
в папке php yii migrate
для применения миграции - создании таблицы каталога
После этого копируем базу в тестовую reezonly -> reezonly_test

Тесты (4 на Создание валидацию удаление обновления каталога)
php vendor/bin/codecept run


Клиентская часть через стандартные REST full get/post/put....
Список http://reezonly-api/api/v1/catalog
Сортировка http://reezonly-api/api/v1/catalog?sort=title
Поиск http://reezonly-api/api/v1/catalog?filter[title][like]=q
Просмотр http://reezonly-api/api/v1/catalog/1

Админская часть аналогична + добавление/изменение/удаление
через http://reezonly-api/api/v1/admin/catalog
Авторизация в head по токену Token: 100-token