# ProContext Test

REST API для управления списком пользователей

## Стек
- PHP
- Laravel
- PostgreSQL

## Функционал

### Просмотр списка пользователей
    GET /api/users

Data Schema (все поля опциональные):

    limit: int
    page: int
### Просмотр конкретного пользователя
    GET /api/users/{id}
### Добавление нового пользователя
    POST /api/users
Data Schema:

    name: string
    email: string
    age: int

### Изменение конкретного пользователя
    PUT /api/users/{id}
Data Schema (все поля опциональные):

    name: string
    email: string
    age: int
### Удаление конкретного пользователя
    DELETE /api/users/{id}

## Запуск
1. Клонировать репозиторий: https://github.com/dromaria/ProContext
2. Создать файл ```.env``` в корне приложения и скопировать в него данные из ```.env.example```
3. Запустить команду:  ```docker-compose up --build```
4. Приложение будет запущено на http://localhost:8876

## Тестирование
Приложение покрыто unit-тестами Pest. Для их запуска выполните команду: `composer tests`

