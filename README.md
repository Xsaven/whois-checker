# Whois checker

Тестовое задание.

## Требования
* PHP `v8.2.25`
* Composer `v2.8.3`
* Node.js `v18.20.5`

## Установка

### Клонирование репозитория
```bash
git clone git@github.com:Xsaven/whois-checker.git
cd whois-checker
```

 ### Установка зависимостей composer
```bash
composer install
```

### Установка зависимостей npm
```bash
npm install
```

### Создание файла окружения
```bash
cp .env.example .env
```

### Генерация ключа приложения
```bash
php artisan key:generate
```

### Создание базы данных
```bash
php artisan migrate
```

### Компиляция ресурсов
```bash
npm run build
```

### Запуск сервера
```bash
php artisan serve
```
После выполнения всех шагов, приложение будет доступно по адресу `http://127.0.0.1:8000/`.
