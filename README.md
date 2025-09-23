# Лабораторная работа №1: Nginx + Docker

## 👩‍💻 Автор
ФИО: Атмакин Дмитрий Михайлович     
Группа: 3МО-1

---

## 📌 Описание задания
Создать веб-сервер в Docker с использованием Nginx и подключить HTML-страницу.  
Результат доступен по адресу [http://localhost:8080](http://localhost:8080).

---

## ⚙️ Как запустить проект

1. Клонировать репозиторий:
   ```bash
   git clone https://github.com/Dumaqkumaq/Docker-start
   cd Docker-start
Запустить контейнеры:
```bash
docker-compose up -d --build
```
Открыть в браузере:
```http://localhost:8080```     

📂 Содержимое проекта   

```screenshots/``` — все скриншоты  

```docker-compose.yml``` — описание сервиса Nginx   

```code/index.html``` — главная HTML-страница   

📸 Скриншоты работы

![plot](./screenshots/1.jpg)    

![plot](./screenshots/2.jpg)    

![plot](./screenshots/3.jpg)   

✅ Результат    
Сервер в Docker успешно запущен, Nginx отдаёт мою HTML-страницу.