# Тестовое задание
## Для запуска проекта необходимо:
1. Подключиться к БД в файле `.env`
2. В файле `.env` изменить переменные `FILESYSTEM_DISK` на `public` и `QUEUE_CONNECTION` на `database`
3. Мигрировать базу данных с сидером `php artisan migrate --seed`
4. Запустить локальный сервер `php artisan serve`
5. Запустить воркера (тк есть jobs для отправки писем) `php artisan queue:work`
6. Перейти по адресу `127.0.0.1:8000`

В сидере создается админ: логин - admin, пароль - 12345

## Версии ПО:
- Apache 2.4
- PHP 8.0
- MySQL 5.7

## Email
Для подтверждения емейла и изменения пароля необходимо подключиться по SMTP, заполнив следующие переменные в `.env`
```
MAIL_MAILER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
```

## API

| №   | Название           | URL                      | Метод  | Необходимые параметры                                      |
|-----|--------------------|--------------------------|--------|------------------------------------------------------------|
| 1   | Все категории      | /api/categories          | GET    |                                                            |
| 2   | Создать категорию  | /api/categories          | POST   | name                                                       |
| 3   | Одна категория     | /api/categories/{id}     | GET    |                                                            |
| 4   | Изменить категорию | /api/categories/{id}     | PATCH  | name                                                       |
| 5   | Удалить категорию  | /api/categories/{id}     | DELETE |                                                            |
| 6   | Все товары         | /api/products            | GET    |                                                            |
| 7   | Один товар         | /api/products/{id}       | GET    |                                                            |
| 8   | Создать товар      | /api/products            | POST   | name, description, price, category_id, image               |
| 9   | Изменить товар     | /api/products/{id}       | PATCH  | name, description, price, category_id, image (опционально) |
| 10  | Удалить товар      | /api/products/{id}       | DELETE |                                                            |
| 11  | Все заказы         | /api/orders              | GET    |                                                            |
| 12  | Один заказ         | /api/orders/{id}         | GET    |                                                            |
| 13  | Подтвердить заказ  | /api/orders/{id}/approve | PATCH  |                                                            |
| 14  | Удалить заказ      | /api/orders/{id}         | DELETE |                                                            |
    
## Различное окружение
Если в `.env` изменить `APP_ENV` с `local` на `develop`, то на странице авторизации станет доступна кнопка `Войти как админ`
