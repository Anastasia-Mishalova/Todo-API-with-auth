# ToDo API с аутентификацией по токену 
REST API с аутентификацией и авторизацией для управления списком задач на Laravel

## Технологии
- PHP
- Laravel
- MySQL
- JSON для запросов и ответов

---

## Маршруты API

### 1. Регистрация
POST http://127.0.0.1:8000/api/register

### 2. Вход
POST http://127.0.0.1:8000/api/login

### 3. Логаут
POST http://127.0.0.1:8000/api/logout

### 4. Получить список всех задач
GET http://127.0.0.1:8000/api/tasks

### 5. Получить одну задачу по id
GET http://127.0.0.1:8000/api/tasks/1

### 6. Создать новую задачу
POST http://127.0.0.1:8000/api/tasks

### 7. Обновить существующую задачу
PUT http://127.0.0.1:8000/api/tasks/1

### 8. Удалить задачу
DELETE http://127.0.0.1:8000/api/tasks/1

---

## Установка и запуск

### 1. Клонировать репозиторий
```
git clone https://github.com/Anastasia-Mishalova/Todo-API-with-auth.git
cd Todo-API-with-auth
```

### 2. Установка PHP-зависимостей
```
composer install
```

### 3. Настройка окружения
Скопируйте пример файла окружения и отредактируйте .env (укажите данные БД и прочие параметры):
```
cp .env.example .env
```

Измените в .env данные на эти и подставьте название своей БД, имя вашего аккаунта и пароль:
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_api_with_auth    #название бд
DB_USERNAME=root                  #имя пользователя бд
DB_PASSWORD=''                    #пароль пользователя бд
```

### 4. Применение миграций
```
php artisan migrate
```

### 5. Запуск локального сервера
```
php artisan serve
```

### 6. Для тестирования маршрутов в консоли выполните следующие команды

#### 1. Регистрация
```
Invoke-RestMethod -Uri "http://127.0.0.1:8000/api/register" `
-Method Post `
-Headers @{ "Content-Type" = "application/json" } `
-Body '{"name":"1","email":"test1@example.com","password":"12345678"}'
```

#### 2. Вход
```
$login = Invoke-RestMethod -Uri "http://127.0.0.1:8000/api/login" `
-Method Post `
-Headers @{ "Content-Type" = "application/json" } `
-Body '{"email":"test1@example.com","password":"12345678"}'

$token = $login.token

$token
```

#### 3. Создать новую задачу
```
Invoke-RestMethod -Uri "http://127.0.0.1:8000/api/tasks" `
-Method Post `
-Headers @{ "Authorization" = "Bearer $token"; "Content-Type" = "application/json" } `
-Body '{"title":"1","description":"1","status":"pending"}'
```


#### 4. Получить список всех задач
```
Invoke-RestMethod -Uri "http://127.0.0.1:8000/api/tasks" `
-Method Get `
-Headers @{ "Authorization" = "Bearer $token" }
```

#### 5. Получить одну задачу по id
```
Invoke-RestMethod -Uri "http://127.0.0.1:8000/api/tasks/1" `
-Method Get `
-Headers @{ "Authorization" = "Bearer $token" }
```

#### 6. Обновить существующую задачу
```
Invoke-RestMethod -Uri "http://127.0.0.1:8000/api/tasks/1" `
-Method Put `
-Headers @{ "Authorization" = "Bearer $token"; "Content-Type" = "application/json" } `
-Body '{"status":"done"}'
```

#### 7. Удалить задачу
```
Invoke-RestMethod -Uri "http://127.0.0.1:8000/api/tasks/1" `
-Method Delete `
-Headers @{ "Authorization" = "Bearer $token" }
```

#### 8. Логаут
```
Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/logout" `
-Method Post `
-Headers @{ "Authorization" = "Bearer $token" } `
-UseBasicParsing
```

---

### Валидация полей
- `title` — обязательно, строка  
- `description` — необязательно, строка  
- `status` — обязательно, одно из значений: `pending`, `in_progress`, `done`

