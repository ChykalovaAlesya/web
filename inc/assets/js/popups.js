document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.getElementById('popup-overlay');
    const popups = document.querySelectorAll('.popup');
    const closeButtons = document.querySelectorAll('.close-popup');

    // Функция для открытия попапа
    function openPopup(popupId) {
        const popup = document.getElementById(popupId);
        if (popup && overlay) {
            // Закрываем все открытые попапы перед открытием нового
            closePopup();
            overlay.style.display = 'block';
            popup.style.display = 'block';
            document.body.style.overflow = 'hidden'; // Запрещаем прокрутку страницы
        }
    }

    // Функция для закрытия всех попапов
    function closePopup() {
        if (overlay) {
            overlay.style.display = 'none';
        }
        popups.forEach(popup => popup.style.display = 'none');
        document.body.style.overflow = ''; // Восстанавливаем прокрутку страницы
    }

    // Закрытие по клику на крестик и на overlay
    if (overlay) {
        overlay.addEventListener('click', closePopup);
    }

    if (closeButtons.length > 0) {
        closeButtons.forEach(button => button.addEventListener('click', closePopup));
    }

    // Открытие попапа по клику на кнопку
    const openPopupButtons = document.querySelectorAll('.open-popup');
if (openPopupButtons.length > 0) {
    openPopupButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Отменяем стандартное поведение ссылки
            // Не даём клику всплыть к внешнему .open-popup (например, кнопка
            // Telegram внутри карточки-послуги, у которой свой data-popup-id).
            event.stopPropagation();
            const popupId = this.getAttribute('data-popup-id');
            openPopup(popupId);
        });
    });
}

    // Предотвращаем закрытие попапа при клике внутри его содержимого
    if (popups.length > 0) {
        popups.forEach(popup => {
            popup.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });
    }
 
    // Событие успешной отправки формы Contact Form 7
    document.addEventListener('wpcf7mailsent', function(event) {
        // Закрываем попап с формой
        closePopup();
    
        // Показываем попап с сообщением об успешной отправке
        openPopup('thankyouPopup');
    
        // Удаляем сообщение от Contact Form 7
        const responseOutput = event.target.querySelector('.wpcf7-response-output');
        if (responseOutput) {
            responseOutput.remove();
        }
    }, false);
    
});



//   <!-- Триггер для открытия попапа -->
// <button class="open-popup" data-popup-id="header-form">Открыть Логин Попап</button>
