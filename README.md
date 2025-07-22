# 🤖 MultiSupport – Telegram Bot for Smart Requests

MultiSupport — это мощный Telegram-бот с поддержкой мультиязычности (6 языков), фото-заявками, админ-панелью и гибкой логикой для приёма заявок от пользователей.

![GitHub repo size](https://img.shields.io/github/repo-size/alibayev03/-MultiSupport?color=blue&style=flat)
![GitHub last commit](https://img.shields.io/github/last-commit/alibayev03/-MultiSupport)
![Made with PHP](https://img.shields.io/badge/Made%20with-PHP-blue.svg)
![Platform](https://img.shields.io/badge/Platform-Telegram-blue)

---

@NEST_ONE_SERVICE_bot бот находиться в рабочем состоянии можете проверить

На видео показано что да как)

[![Watch the video](https://img.youtube.com/vi/yrpeFaVVW08/0.jpg)](https://youtu.be/yrpeFaVVW08)



## 🚀 Возможности

- 🌐 Поддержка 7 языков: 🇷🇺 Русский, 🇺🇿 Узбекский, 🇬🇧 Английский, 🇸🇦 Арабский, 🇰🇷 Корейский, 🇨🇳 Китайский, 🇹🇷 Турецкий
- 📷 Заявки с возможностью прикрепления фото (необязательно)
- 🧑‍💼 Админ-панель с возможностью CRUD-управления
- 🗂 Удаление пользователей и заявок
- 🌐 Работает через локальный сервер (Ngrok, Playit.gg и т.д.)
- 📩 Заявки отправляются в Telegram-группу

---

## 🛠️ Технологии

- **PHP** – backend-логика
- **JavaScript** – интерактивная админ-панель
- **MySQL** – хранение заявок и пользователей
- **Telegram Bot API** – отправка и обработка заявок

---

## 📦 Установка

```bash
git clone https://github.com/alibayev03/-MultiSupport.git
cd MultiSupport


Настройте данные подключения к БД в config.php

Разверните базу данных (файл init.sql)

Установите веб-сервер (например, OpenServer или XAMPP)

Запустите проект в браузере

## 🚀 Локальный запуск

Для корректной работы Telegram-бота в локальной среде требуется **вебхук**, направленный на ваш локальный сервер. Вы можете использовать такие сервисы, как:

- [Ngrok](https://ngrok.com/)
- [LocalXpose](https://localxpose.io/)
- [Playit](https://playit.gg/)

Пример запуска с помощью ngrok:

```bash
ngrok http 80

https://api.telegram.org/bot<ВАШ_ТОКЕН>/setWebhook?url=https://<ВАШ_АДРЕС>.ngrok.io
👉 Замените <ВАШ_ТОКЕН> и <ВАШ_АДРЕС> на актуальные значения.

🤝 Авторы
🇺🇿 Aliboev Farrux — разработка и поддержка
GitHub профайл

📄 Лицензия
Этот проект распространяется под лицензией MIT. Свободно используйте, адаптируйте и распространяйте. 💼

⭐️ Поддержи проект
Если тебе понравилось — поставь звезду ⭐️ на GitHub!
