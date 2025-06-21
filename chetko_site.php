<!DOCTYPE html>
<html lang="ru">
<header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/modern-normalize/3.0.1/modern-normalize.css">
    <link rel="stylesheet" href="./css/xyinya.css">
</header>
<div class="backdrop is-hidden" data-backdrop>
    <div class="modal">
            <form>
                <h2 class="form-title bid">Войти</h2>
                <button class="close-modal"></button>
                <ul class="list form-field">
                    <li class="item-list">
                        <label class="item">
                            <input type="text" name="text" class="form-input bid" placeholder="">
                            <span class="form-label">Фамилия</span>
                        </label>
                    </li>
                    <li class="item-list">
                        <label class="item">
                            <input type="tel" name="tel" class="form-input bid" placeholder="">
                            <span class="form-label">Имя</span>
                        </label>
                    </li>
                     <li class="item-list">
                        <label class="item">
                            <input type="tel" name="tel" class="form-input bid" placeholder="">
                            <span class="form-label">Отчество</span>
                        </label>
                    </li>
                     <li class="item-list">
                        <label class="item">
                            <input type="tel" name="tel" class="form-input bid" placeholder="">
                            <span class="form-label">Пароль</span>
                        </label>
                    </li>
                    <li class="item-list">
                        <label class="item">
                            <input type="email" name="mail" class="form-input bid" placeholder="">
                            <span class="form-label">Email</span>
                        </label>
                    </li>
                </ul>
                <button class="modal-buttn" type="submit">Войти</button>
            </form>
    </div>
</div>
<body>
    <header>
        <div class="header-flex">
            <a href="/chetko_site.php" class="logo"></a>
                <nav>
                    <ul class="nav-list ger">
                        <li class="item-nav">О нас</li>
                        <li class="item-nav">Автосалон</li>
                        <li class="item-nav">Услуги</li>
                        <li class="item-nav">Контакты</li>
                        <li class="item-nav reg">Войти</li>
                    </ul>
                </nav>
            <button type="button" class="littleclose"></button>
        </div>
    </header>
    <main>
        <section class="hero-bg first">
            <div class="center hero">
                <h1 class="title-section">РЕГИОНАЛЬНЫЙ ЦЕНТР<br> АВТОРИТЕЙЛА</h1>
                    <ul class="hero-list">
                        <li class="hero-item">Покупка, продажа, ремонт, обслуживание</li>
                        <li class="hero-item">Автомобили новые и с пробегом</li>
                    </ul>
            </div>
        </section>
        <section class="is-nothing">
            <div>
                <ul class="list is-nothing-list">
                    <li class="is-nothing-item">
                        <span class="is-nothing-text">> 600</span>
                        <h2 class="is-nothing-title">Автомобилей</h2>
                    </li>
                    <li class="is-nothing-item">
                        <span class="is-nothing-text">20 000 м²</span>
                        <h2 class="is-nothing-title">Площадь экспозиции</h2>
                    </li>
                    <li class="is-nothing-item">
                        <span class="is-nothing-text">> 20</span>
                        <h2 class="is-nothing-title">Автосалонов</h2>
                    </li>
                </ul>
            </div>
        </section>
        <section>
            <div class="center-info">
            <div class="information-sect">
                <ul class="list img-list">
                    <li class="img-itemlist"><img src="./images/tachka_1.1.jpg" class="img-item" alt="auto" width="400px"></li>
                    <li class="img-itemlist"><img src="./images/tachka_2.1.jpg" class="img-item" alt="auto" width="400px"></li>
                </ul>
                <div class="salon-info">
                    <h1 class="title information-title">Мармеладные <span class="span-info">червячки</span></h1>
                    <p>я основал этот автосалон по просьбе моего другана и хочу продавать тут тачки за дорого кароче и ваще все вы идите нахуй</p>
                </div>
            </div>
            </div>
        </section>
        <section class="cars_showroom">
            <div class="center">
            <h1 class="title car_showroom-title">Автосалоны</h1>
                <ul class="list car_showroom-list">
                    <li class="car_showroom-item">
                        <a href="./dima_site.php" class="link">
                            <img src="./images/jaecoo_1.jpg" class="image-radius" alt="" width="360" height="270">
                            <div class="pos-card">
                                <h2 class="title-card">ЕВРАЗИЯ JAECOO</h2>
                                <p class="subhead-card">
                                    JAECOO — больше, чем автомобиль. Надежный проводник в мир тех, с кем тебе точно по пути. И мощный навигатор, позволяющий исследовать мир возможностей на максимум. JAECOO помогает жить в разных режимах настоящего, получая бесценное удовольствие быть настоящим — во всем.
                                </p>
                                <button type="button" class="button main">Подробнее</button>
                            </div>
                        </a>
                    </li>
                    <li class="car_showroom-item">
                        <a href="./german.php" class="link">
                            <img src="./images/omoda_4.jpg" class="image-radius" alt="">
                            <div class="pos-card">
                                <h2 class="title-card">ЕВРАЗИЯ OMODA</h2>
                                <p class="subhead-card">
                                    Бренд OMODA – это определенная философия и даже целая Вселенная O-Universe, где встретились: собственное комьюнити (O-Club), неординарный подход к образу жизни (O-Life), оригинальный модный дизайн (O-Style) и технологии (O-Tech).
                                </p>
                                <button type="button" class="button main">Подробнее</button>
                            </div>
                        </a>
                    </li>
                        <li class="car_showroom-item">
                            <a href="./german2.php" class="link">
                                <img src="./images/geely_1.jpg" class="image-radius" alt="" width="360" height="270">
                                <div class="pos-card">
                                    <h2 class="title-card">ЕВРАЗИЯ GEELY</h2>
                                    <p class="subhead-card">
                                        Geely — крупный китайский автопроизводитель, основанный в 1986 году. Компания выпускает современные и доступные автомобили, включая электромобили. В 2010 году Geely купила шведский Volvo, что укрепило её позиции на мировом рынке.
                                    </p>
                                    <button type="button" class="button main">Подробнее</button>
                                </div>
                            </a>
                        </li>
                </ul>
            </div>
            </section>
        <section>
            <div class="center">
            <h1 class="title main-cars">Новые <span class="span-color">автомобили</span></h1>
            <ul class="list main-cars-list">
                <li class="main-cars-item">
                    <img src="./images/car_new1.1.png" class="img-cars" alt="car_new">
                    <img src="./images/car_new1.2.png" class="img-cars second" alt="car_new">
                    <h2 class="cars-title">Zeekr X</h2>
                    <p class="subhead-cars">Электро 428 л.с</p>
                    <h3 class="un-title-cars">3 795 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/car_new2.1.png" class="img-cars" alt="car_new">
                    <img src="./images/car_new2.2.png" class="img-cars second" alt="car_new">
                    <h2 class="cars-title">Toyota Camry XV80</h2>
                    <p class="subhead-cars">2.0 hyb (197 л.с) CVT</p>
                    <h3 class="un-title-cars">4 490 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/car_new3.1.png" class="img-cars" alt="car_new">
                    <img src="./images/car_new3.2.png" class="img-cars second" alt="car_new">
                    <h2 class="cars-title">BMW 5</h2>
                    <p class="subhead-cars">Двигатель - 2.5 (205 л.с) 230 л.с</p>
                    <h3 class="un-title-cars">1 849 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/car_new4.1.jpg" class="img-cars" alt="car_new">
                    <img src="./images/car_new4.2.jpg" class="img-cars second" alt="car_new">
                    <h2 class="cars-title">OMODA C5</h2>
                    <p class="subhead-cars">1.6 Turbo AWD</p>
                    <h3 class="un-title-cars">1 889 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/car_new5.1.png" class="img-cars" alt="car_new">
                    <img src="./images/car_new5.2.png" class="img-cars second" alt="car_new">
                    <h2 class="cars-title">JAECOO J7</h2>
                    <p class="subhead-cars">1.6 Turbo 186 л.c AWD</p>
                    <h3 class="un-title-cars">2 449 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/car_new6.1.jpg" class="img-cars" alt="car_new">
                    <img src="./images/car_new6.2.jpg" class="img-cars second" alt="car_new">
                    <h2 class="cars-title">JAECOO J8</h2>
                    <p class="subhead-cars">2.0 AWD 249 л.с</p>
                    <h3 class="un-title-cars">3 899 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/car_new7.1.png" class="img-cars" alt="car_new">
                    <img src="./images/car_new7.2.png" class="img-cars second" alt="car_new">
                    <h2 class="cars-title">Geely Monjaro</h2>
                    <p class="subhead-cars">Бензин 2.0 238 л.c</p>
                    <h3 class="un-title-cars">3 839 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/car_new8.1.jpg" class="img-cars" alt="car_new">
                    <img src="./images/car_new8.2.jpg" class="img-cars second" alt="car_new" height="240" width="360">
                    <h2 class="cars-title">Haval h3</h2>
                    <p class="subhead-cars">Бензин 1.5 170 л.с</p>
                    <h3 class="un-title-cars">2 489 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/car_new9.1.png" class="img-cars" alt="car_new">
                    <img src="./images/car_new9.2.png" class="img-cars second" alt="car_new">
                    <h2 class="cars-title">Geely Preface</h2>
                    <p class="subhead-cars">Бензин 2.0 200 л.с</p>
                    <h3 class="un-title-cars">3 099 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/car_new10.1.png" class="img-cars" alt="car_new" height="240">
                    <img src="./images/car_new10.2.png" class="img-cars second" alt="car_new" height="240" width="360">
                    <h2 class="cars-title">lixiang l9</h2>
                    <p class="subhead-cars">52.3 kWh 1.5hyb AT (449 л.с.) 4WD (Гибрид)</p>
                    <h3 class="un-title-cars">9 400 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/car_new11.1.png" class="img-cars" alt="car_new" height="240" width="360">
                    <img src="./images/car_new11.2.png" class="img-cars second" alt="car_new" height="240" width="360">
                    <h2 class="cars-title">lixiang l8</h2>
                    <p class="subhead-cars">1.5 л, 154 л.с., бензин, полный привод (4WD), гибрид</p>
                    <h3 class="un-title-cars">6 090 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/car_new12.1.png" class="img-cars" alt="car_new" height="240" width="360">
                    <img src="./images/car_new12.2.png" class="img-cars second" alt="car_new" height="240" width="360">
                    <h2 class="cars-title">lixiang l7</h2>
                    <p class="subhead-cars">Гибрид 1.5 AT449 л.с. 4x4</p>
                    <h3 class="un-title-cars">4 990 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                </ul>
                </div>
            </section>
            <section>
            <div class="center use">
            <h1 class="title used_car">Автомобили <span class="span-info">с пробегом</span></h1>
            <ul class="list main-cars-list">
                <li class="main-cars-item">
                    <img src="./images/use_car1.1.jpg" class="img-cars" alt="use_car">
                    <img src="./images/use_car1.2.jpg" class="img-cars second" alt="use_car">
                    <h2 class="cars-title">Ваз 1111</h2>
                    <p class="subhead-cars">бензин 53 л.с</p>
                    <h3 class="un-title-cars">767 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/use_car2.1.jpg" class="img-cars" alt="use_car">
                    <img src="./images/use_car2.2.jpg" class="img-cars second" alt="use_car">
                    <h2 class="cars-title">Ваз 2109</h2>
                    <p class="subhead-cars">Бензин 78 л.с</p>
                    <h3 class="un-title-cars">267 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/use_car3.1.jpg" class="img-cars" alt="use_car">
                    <img src="./images/use_car3.2.jpg" class="img-cars second" alt="use_car">
                    <h2 class="cars-title">Land Rover</h2>
                    <p class="subhead-cars">Бензин 330 л.с</p>
                    <h3 class="un-title-cars">1 300 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/use_car4.1.jpg" class="img-cars" alt="use_car">
                    <img src="./images/use_car4.2.jpg" class="img-cars second" alt="use_car">
                    <h2 class="cars-title">Honda civic</h2>
                    <p class="subhead-cars">Безин 113 л.с</p>
                    <h3 class="un-title-cars">730 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/use_car5.1.jpg" class="img-cars" alt="use_car">
                    <img src="./images/use_car5.2.jpg" class="img-cars second" alt="use_car">
                    <h2 class="cars-title">Lexus SC300</h2>
                    <p class="subhead-cars">Бензон 280 л.с</p>
                    <h3 class="un-title-cars">878 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/use_car6.1.jpg" class="img-cars" alt="use_car">
                    <img src="./images/use_car6.2.jpg" class="img-cars second" alt="use_car">
                    <h2 class="cars-title">Toyota Avensis</h2>
                    <p class="subhead-cars">1.8 MT 129 л.с</p>
                    <h3 class="un-title-cars">1 075 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/use_car7.1.jpg" class="img-cars" alt="use_car">
                    <img src="./images/use_car7.2.jpg" class="img-cars second" alt="use_car">
                    <h2 class="cars-title">Mitsubishi Lancer</h2>
                    <p class="subhead-cars">1.3 MT 82 л.с</p>
                    <h3 class="un-title-cars">540 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/use_car8.1.jpg" class="img-cars" alt="use_car">
                    <img src="./images/use_car8.2.jpg" class="img-cars second" alt="use_car">
                    <h2 class="cars-title">Volkswagen Touareg</h2>
                    <p class="subhead-cars">3.0 AT 249 л.с</p>
                    <h3 class="un-title-cars">6 100 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
                <li class="main-cars-item">
                    <img src="./images/use_car9.1.jpg" class="img-cars" alt="use_car">
                    <img src="./images/use_car9.2.jpg" class="img-cars second" alt="use_car">
                    <h2 class="cars-title">Lexus ES </h2>
                    <p class="subhead-cars">2.5 AT 184 л.с</p>
                    <h3 class="un-title-cars">3 200 000 р.</h3>
                    <div class="div-butt">
                        <button type="button" class="button main">Узнать больше</button>
                        <button type="button" class="button secondary">Оставить заявку</button>
                    </div>
                </li>
            </ul>
            </div>
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
        </section>
        <section class="center-services">
            <h1 class="title Services-title">Услуги</h1>
            <ul class="list Services-list">
                <li class="Services-item credit">
                    <a href="" class="link">
                        <img src="./images/xz1.png" class="img-service" alt="" width="223" height="190">
                        <h3 class="title title-servs credit">АвтоКредит</h3>
                        <p class="subhead-servs credit">Расчитать<br> ежемесечный платеж</p>
                        <button type="button" class="button service-button ">подробнее</button>
                    </a>
                </li>
                <li class="Services-item Trade-In">
                    <a href="" class="link">
                        <img src="./images/xz2.png" class="img-service" alt="" width="223" height="190">
                        <h3 class="title title-servs">Trade-In</h3>
                        <p class="subhead-servs Trade-In">Обменять свой автомобиль на новый</p>
                    <button type="button" class="button service-button Trade-In">подробнее</button>
                    </a>
                </li>
                <li class="Services-item lising">
                    <a href="" class="link">
                        <img src="./images/xz3.png" class="img-service" alt="" width="223" height="190">
                        <h3 class="title title-servs">Лизинг</h3>
                        <p class="subhead-servs">Индивидуальное предложение аренды</p>
                        <button type="button" class="button service-button lising">подробнее</button>
                    </a>
                </li>
            </ul>
        </section>
        <section>
            <h1 class="title auto-service-title">Автосервис</h1>
            <div class="center auto-service">
                <ul class="list auto-service-list">
                <li class="auto-service-item car-wash">
                    <div class="text-auto-service">
                        <h2 class="auto-service-subtitle">Автомойка</h2>
                        <p class="auto-service-subhead">
                            Чистый автомобиль – отображение отношения к нему владельца,
                            своеобразное «зеркало». Наш центр рад предложить вам услуги автомойки.
                            Цена процедуры доступна каждому. С нами вы почувствуете,
                            что помыть машину – это быстро и легко
                        </p>
                    </div>
                </li>
                <li class="auto-service-item detailing">
                    <div class="text-auto-service">
                        <h2 class="auto-service-subtitle">Детейлинг</h2>
                        <p class="auto-service-subhead">
                            Детейлинг включает в себя ряд процедур,
                            таких как комплексная мойка автомобиля, обезжиривание кузова,
                            очистка глиной, восстановительная и защитная полировки кузова,
                            полировка передней оптики и задних фонарей
                        </p>
                    </div>
                </li>
                <li class="auto-service-item tire-fitting">
                    <div class="text-auto-service">
                        <h2 class="auto-service-subtitle">Шиномонтаж</h2>
                        <p class="auto-service-subhead">
                            Профессиональный шиномонтаж и балансировка.<br> 
                            Обязательное условие для безопасной езды на автомобиле – смена покрышек в летний и зимний сезон.
                            Для каждого сезона предусмотрены шины с определенными техническими качествами.
                        </p>
                    </div>
                </li>
                </ul>
            </div>
        </section>
        <section class="hero-bg second">
            <form class="form-pos">
                <h1 class="form-title">Ответим на любой вопрос</h1>
                <ul class="list form-field">
                    <li class="item-list">
                        <label class="item">
                            <input type="text" name="text" class="form-input" placeholder=" ">
                            <span class="form-label">ФИО</span>
                        </label>
                    </li>
                    <li class="item-list">
                        <label class="item">
                            <input type="email" name="mail" class="form-input" placeholder=" ">
                            <span class="form-label">E-mail</span>
                        </label>
                    </li>
                    <li class="item-list">
                        <label class="item">
                            <textarea name="comment" cols="20" rows="7" placeholder="" class="form-input" placeholder="comment"></textarea>
                        </label>
                    </li>
                </ul>
                <button type="submit" class="button-form">ОТПРАВИТЬ</button>
                <p>
                    <label for="oferta">
                        <input type="checkbox">
                        <span>Я даю согласие на обработку персональных данных</span>
                    </label>
                </p>
            </form>
        </section>
    </main>
<footer>
<div class="bg-footer">
    <div class="center footer">
            <div class="info-down">
                <a href="/chetko_site.php" class="logo down"></a>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Находим элементы
        const heroLink = document.querySelector('.littleclose');
        const modal = document.querySelector('.nav-list.ger');
        
      
        // Проверяем, что все элементы существуют
        if (heroLink && modal) {
          // Открываем модальное окно при клике на кнопку
          heroLink.addEventListener('click', function(e) {
            e.preventDefault(); // Предотвращаем действие по умолчанию (если это ссылка)
            modal.classList.toggle('ger');
          });
        } else {
          console.error('Один из элементов не найден! Проверьте классы элементов.');
        }
      });
</script>
        </html>