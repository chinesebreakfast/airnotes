# AirNotes 📝

Учебный REST API проект на PHP для управления заметками

## 🚀 О проекте

AirNotes - это простое REST API приложение для создания и управления текстовыми заметками. Проект разработан в учебных целях для освоения принципов RESTful архитектуры и работы с PHP.

## 🔧 Технологии

- **Backend**:
  - PHP 8.0+
  - MySQL (phpmyadmin)
  - OpenServer
  
- **Архитектура**:
  - RESTful API
  - MVC-подход
  - Роутинг через единую точку входа (Front Controller)

## 📌 Основные возможности

- Создание заметок (POST /api/posts)
- Просмотр всех заметок (GET /api/posts)
- Удаление заметок (DELETE /api/posts/{id})
- Валидация входных данных

## 🛠️ Установка

1. Клонируйте репозиторий:
```bash
git clone https://github.com/chinesebreakfast/airnotes.git
```

## 📡 API Documentation
### Base URL
http://domain/api

### Получить все заметки
Запрос: ```GET /posts```
Ответ:
```
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "label": "Note title",
      "text": "Note content"
    }
  ]
}
```
### Создание заметки

Запрос: POST /posts
Headers:
  Content-Type: application/json

Request Body:
{
  "label": "New note",
  "text": "Note content"
}
Ответ:
{
  "status": "success",
  "id": 2
}

Ошибки: 400 - пустой заголовок, 500 - ошибка сервера

### Удаление заметки

Запрос: DELETE /posts/{id}
Ответ:
{
  "status": "success"
}

Ошибки: 404 - заметка не найдена, 500 - ошибка сервера
