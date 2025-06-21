<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/modern-normalize/3.0.1/modern-normalize.css">
    <link rel="stylesheet" href="./css/xyinya.css">
    <link rel="stylesheet" href="./css/dima.css">
</head>
<div class="backdrop is-hidden" data-backdrop>
    <div class="modal">
            <form>
                <h2 class="form-title bid">Заявка</h2>
                <button class="close-modal"></button>
                <ul class="list form-field">
                    <li class="item-list">
                        <label class="item">
                            <input type="text" name="text" class="form-input bid" placeholder="">
                            <span class="form-label">Name</span>
                        </label>
                    </li>
                    <li class="item-list">
                        <label class="item">
                            <input type="tel" name="tel" class="form-input bid" placeholder="">
                            <span class="form-label">Phone</span>
                        </label>
                    </li>
                    <li class="item-list">
                        <label class="item">
                            <input type="email" name="mail" class="form-input bid" placeholder="">
                            <span class="form-label">Email</span>
                        </label>
                    </li>
                </ul>
                <button class="modal-buttn" type="submit">Отправить</button>
            </form>
    </div>
</div>
<body>
    <header>
        <div class="header-flex">
            <a href="/chetko_site.php" class="link logo">Мармеладные <span class="logo-text">червячки</span></a>
                <nav>
                    <ul class="list nav-list">
                        <li class="item-nav">О нас</li>
                        <li class="item-nav">Автосалон</li>
                        <li class="item-nav">Услуги</li>
                        <li class="item-nav">Контакты</li>
                        <li class="item-nav reg">Регистрация</li>
                    </ul>
                </nav>
        </div>
    </header>
    <main>
        <section class="Hero omoda">
            <h2>ЕВРАЗИЯ OMODA</h2>
        </section>
        <section class="Description">
            <h2>О Бренде</h2>
            <div class="DescriptionH2border"></div>
            <p class="DescriptionText">
                OMODA - бренд, движимый технологиями будущего. Динамичные линии кузова, смелые дизайнерские решения и современные мультимедийные системы делают автомобили OMODA по-настоящему неповторимыми. OMODA создан для тех, кто ценит стиль, комфорт и безопасность на каждом участке пути.
                Станьте и Вы частью Вселенной OMODA вместе с Автосалоном Евразия! Ждем Вас в нашем шоуруме.
            </p>
            <p class="Descriptionlink">Телефон <span>+73532405000</span></p>
            <div class="DescriptionPhoto">
                <ul class="DescriptionUl">
                    <li><img src="./images/omoda_1.jpg" alt="omoda"></li>
                    <li><img src="./images/omoda_2.jpg" alt="omoda"></li>
                    <li><img src="./images/omoda_3.jpg" alt="omoda"></li>
                </ul>
            </div>
        </section>
        <section class="Catalog omoda">
            <div>
                <h3 class="title-omoda">C5</h3>
                <p class="omoda-sub">От 2 049 000 ₽</p>
                <p class="CatalogText omoda">Стильная решетка радиатора, 18” двухцветные литые диски, «парящая» крыша, динамичный кузов фастбэк, Т-образные дневные ходовые огни, динамичные сигналы поворота – каждый элемент подчеркивает спортивный современный образ автомобиля Omoda C5.</p>
            </div>
        </section>
        <section class="FormSection">
            <form action="#" method="post" autocomplete="off" class="form">
                <h2>Форма для связи</h2>
                <input class="FormInput" type="text" placeholder="Имя">
                <input class="FormInput" type="text" placeholder="Телефон">
                <button class="FormButton">Отправить</button>
            </form>
        </section>
    </main>
<footer>
<div class="bg-footer">
    <div class="center footer">
            <div class="info-down">
            <a href="/chetko_site.php" class="link logo down">Мармеладные <span class="logo down">червячки</span></a>
                <p> &copy; Четкий автосалон мой <br>
                кто спиздит тому ваще пизда будет
                </p>
            </div>
            <ul class="list down-list">
                <li class="item-down">
                    <h2 class="title footer-title">Автомобили</h2>
                        <ul class="list footer-list">
                            <li class="footer-item">Новые авто</li>
                            <li class="footer-item">Авто с пробегом</li>
                            <li class="footer-item">Новости</li>
                        </ul>
                </li>
                <li class="item-down">
                        <h2 class="title footer-title">Услуги</h2>
                            <ul class="list footer-list">
                                <li class="footer-item">Автокредит</li>
                                <li class="footer-item">Лизинг</li>
                                <li class="footer-item">Трейд-ин</li>
                            </ul>
                </li>
                <li class="item-down">
                        <h2 class="title footer-title">Сервис</h2>
                            <ul class="list footer-list">
                                <li class="footer-item">Шиномонтаж</li>
                                <li class="footer-item">Детейлинг</li>
                                <li class="footer-item">Автомойка</li>
                            </ul>
                </li>
                <li class="item-down">
                        <h2 class="title footer-title">Контакты</h2>
                            <ul class="list footer-list">
                                <li class="footer-item">+7 (1337) 14-88-69</li>
                                <li class="footer-item">pochtadolbaeba@mail.ru</li>
                            </ul>
                </li>
            </ul>
            <ul class="list media-list">    
                <li class="media-item">
                    <a href="" aria-label="Telegram">
                        <svg class="svg-social" width="20" height="20">
                            <use href="./images/symbol-defs.svg#icon-icon-send"></use>
                        </svg>
                    </a>
                </li>
                <li class="media-item">
                    <a href="" aria-label="VK">
                        <svg class="svg-social" width="20" height="20">
                            <use href="./images/symbol-defs.svg#icon-vk-svgrepo-com"></use>
                        </svg>
                    </a>
                </li>
            </ul>
    </div>
</div>
</footer>
</body>
</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Находим элементы
    const heroLink = document.querySelector('.reg');
    const modal = document.querySelector('.backdrop.is-hidden');
    const closeButton = document.querySelector('.close-modal');
  
    // Проверяем, что все элементы существуют
    if (heroLink && modal && closeButton) {
      // Открываем модальное окно при клике на кнопку
      heroLink.addEventListener('click', function(e) {
        e.preventDefault(); // Предотвращаем действие по умолчанию (если это ссылка)
        modal.classList.remove('is-hidden');
      });
  
      // Закрываем модальное окно при клике на кнопку закрытия
      closeButton.addEventListener('click', function() {
        modal.classList.add('is-hidden');
      });
    } else {
      console.error('Один из элементов не найден! Проверьте классы элементов.');
    }
  });
</script>