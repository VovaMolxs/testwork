<p align="center">
Что сделано:

</p>

## Форма
   - Форма содержит все поля согласно тз

## Backend логика
   - Форма сделана через blade шаблон(Пробовал через livewire, но он пока сопративляется)
   - Контроллер обрабатывает и проверяет данные перед отправкой в БД
   - Файлы хранятся локально в бд записывается путь до файла через разделитель
   - Форма отправляется асинхронно, сначала сделал не асинхронно и условие из ТЗ(неверные данные оставлять заполненными) выполнялось.
   - Если форма успешно добавляется в БД, удаляем содержимое страницы и выводим инфу о добавленных данных
  
## Фронтенд
   - Валидация формы и всех ее полей сделана с помощью js и jquery
   - Отправка по enter отключена с помощью js
   - Если валидация прошла(после активации checkbox) button становится активным
   - Если не провалидировалсь успешно, все обводится и показываются ошибки
   - Есть кнопка добавить номер телефона, максимум 5 штук
   - Email или телефон на выбор, или два обязательно
   - (не сделал) Поле "О себе" можно растянуть только вниз и не более чем на 7 строк 

<a href='https://www.veed.io/view/eb566375-22a0-4f07-bfb8-3c15778b8f03?sharingWidget=true&panel=share' >Ссылка на видео </a>

ps

Оставил компонент livewire и views для него, решил не удалять) вдруг зачтется )

