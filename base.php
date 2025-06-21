<?php
session_start();

// Конфигурация базы данных
define('DB_HOST', 'localhost');
define('DB_NAME', 'cars');
define('DB_USER', 'root');
define('DB_PASS', '');

$errors = [];
$success_messages = [];

// Функция для получения PDO подключения
function getPDOConnection() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $pdo = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_PERSISTENT => true
                ]
            );
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }
    
    return $pdo;
}

// === ОБРАБОТЧИК ДОБАВЛЕНИЯ НОВОЙ МАШИНЫ ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_car'])) {
    try {
        $pdo = getPDOConnection();

        // Получаем поля формы
        $title       = trim($_POST['carTitle']);
        $price       = trim($_POST['carPrice']);
        $year        = trim($_POST['carYear']);
        $specs       = trim($_POST['carSpecs']);
        $description = trim($_POST['carDescription']);

        // Читаем бинарники изображений
        $mainImg = file_get_contents($_FILES['mainImage']['tmp_name']);
        $secImg  = file_get_contents($_FILES['secondaryImage']['tmp_name']);

        // SQL вставка
        $stmt = $pdo->prepare("
            INSERT INTO carlist
            (title, price, year, specs, description, mainImg, secImg)
            VALUES
            (:title, :price, :year, :specs, :description, :mainImg, :secImg)
        ");
        $stmt->execute([
            ':title'       => $title,
            ':price'       => $price,
            ':year'        => $year,
            ':specs'       => $specs,
            ':description' => $description,
            ':mainImg'     => $mainImg,
            ':secImg'      => $secImg,
        ]);

        $_SESSION['success_message'] = "Машина «{$title}» добавлена!";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;

    } catch(PDOException $e) {
        $errors[] = "Ошибка при добавлении машины: " . $e->getMessage();
    }
}

// === ОБРАБОТЧИК УДАЛЕНИЯ МАШИНЫ ===
if (isset($_GET['delete_car_id'])) {
    try {
        $pdo = getPDOConnection();
        $stmt = $pdo->prepare("DELETE FROM carlist WHERE id = ?");
        $stmt->execute([ (int)$_GET['delete_car_id'] ]);
        // Если AJAX-запрос, вернём HTTP 200
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            http_response_code(200);
            exit;
        }
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    } catch(PDOException $e) {
        $errors[] = "Ошибка при удалении: " . $e->getMessage();
    }
}


// Обработка данных формы входа
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    try {
        $pdo = getPDOConnection();

        $email = trim($_POST['email']);
        $password = $_POST['password'];

        // Поиск пользователя по email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            // Проверка пароля
            if ($user['password'] == $password) {
                // Успешный вход
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['fn'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role_id'];
                $_SESSION['user_ln'] = $user['ln'] ?? ''; // Фамилия
                $_SESSION['user_fn'] = $user['fn'] ?? ''; // Имя
                $_SESSION['user_sn'] = $user['sn'] ?? ''; // Отчество
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            } else {
                $errors[] = "Неверный пароль";
            }
        } else {
            $errors[] = "Пользователь с таким email не найден";
        }
    } catch(PDOException $e) {
        $errors[] = "Ошибка базы данных: " . $e->getMessage();
    }
}

// Обработка выхода
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Обработка отправки заявки
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_application'])) {
    if (!isset($_SESSION['user_id'])) {
        $errors[] = "Для подачи заявки необходимо авторизоваться";
    } else {
        try {
            
            
            $pdo = getPDOConnection();
            
            // Получаем тип заявки из формы
            $application_type = $_POST['application_type'];
            $car_model = $_POST['car_model'] ?? null;
            
            // Формируем текст заявки
            $zayavk_text = $application_type;
            if ($car_model) {
                $zayavk_text .= " (Модель: " . $car_model . ")";
            }
            
            // Подготавливаем данные для вставки
            $data = [
                'ln' => $_SESSION['user_ln'],
                'fn' => $_SESSION['user_fn'],
                'sn' => $_SESSION['user_sn'],
                'zayavk' => $zayavk_text,
                'status' => 'Новая',
                'email' => $_SESSION['user_email'],
            ];
            
            // Вставляем заявку в базу данных
            $stmt = $pdo->prepare("INSERT INTO zayavka (ln, fn, sn, zayavk, status, email) 
                                   VALUES (:ln, :fn, :sn, :zayavk, :status, :email)");
            $stmt->execute($data);
            
            // Сохраняем сообщение в сессии и делаем редирект
            $_SESSION['success_message'] = "Заявка на '{$application_type}' успешно отправлена!";
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
            
        } catch(PDOException $e) {
            $errors[] = "Ошибка при отправке заявки: " . $e->getMessage();
        }
    }
}

// Показываем сообщение из сессии (если есть)
if (isset($_SESSION['success_message'])) {
    $success_messages[] = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Удаляем сообщение после показа
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Автоцетр Колесо</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/modern-normalize/3.0.1/modern-normalize.css">
    <link rel="stylesheet" href="./css/2.css">
    <style>
        .auth {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: auto;
            padding-right: 20px;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-name {
            font-weight: bold;
            color: #333;
        }
        
        .logout-btn {
            padding: 8px 15px;
            background-color: #ca2a39;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        
        .logout-btn:hover {
            background-color: #a72230;
        }
        
        .login-link {
            padding: 8px 15px;
            background-color: #3498db;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
            font-size: 14px;
        }
        
        .login-link:hover {
            background-color: #2980b9;
        }

        /* Скрываем пункт меню Авторизация после входа */
        .auth-hidden {
            display: none;
        }
        
        /* Стили для уведомлений */
        .notification {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 15px 25px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            animation: fadeIn 0.3s, fadeOut 0.3s 2.7s forwards;
            display: none;
            font-size: 16px;
            text-align: center;
            max-width: 80%;
        }
        
        .notification.error {
            background-color: #f44336;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translate(-50%, -40%); }
            to { opacity: 1; transform: translate(-50%, -50%); }
        }
        
        @keyframes fadeOut {
            from { opacity: 1; transform: translate(-50%, -50%); }
            to { opacity: 0; transform: translate(-50%, -60%); }
        }
        
        .hidden-form {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Уведомление -->
    <div id="notification" class="notification"></div>
    
    <!-- Скрытая форма для отправки заявки -->
    <form id="applicationForm" class="hidden-form" method="POST">
        <input type="hidden" name="submit_application" value="1">
        <input type="hidden" id="applicationTypeInput" name="application_type" value="">
        <input type="hidden" id="carModelInput" name="car_model" value="">
    </form>

    <header>
        <div class="header-flex">
            <a href="/base.php" class="logo"></a>
            <nav>
                <ul class="nav-list ger">
                    <li class="item-nav" id="btn1">О нас</li>
                    <li class="item-nav" id="btn2">Автосалон</li>
                    <li class="item-nav" id="btn3">Услуги</li>
                    <li class="item-nav" id="btn6">Автосервис</li>
                    <li class="item-nav <?php echo isset($_SESSION['user_id']) ? 'auth-hidden' : ''; ?>" id="btn4">Авторизация</li>
                    <?php if (isset($_SESSION['user_id']) && (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 2)): ?>
                        <li class="button main" style="margin: 20px 20px 20px 0px; display: block;" id="btn5">
                            <a href="/zayavki.php" style="color: white; text-decoration: none;">Поданные заявки</a>
                        </li>
                    <button id="addCarBtn" class="button main" style="margin: 20px auto; display: block;">Добавить новую машину</button>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 2): ?>
                    <?php endif; ?>
                </ul>
            </nav>
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
        <section id="info">
            <div class="center-info">
            <div class="information-sect">
                <ul class="list img-list">
                    <li class="img-itemlist"><img src="./images/oper_1.jpg" class="img-item" alt="auto" width="400px" height="340"></li>
                    <li class="img-itemlist"><img src="./images/use_car666.jpg" class="img-item" alt="auto" width="400px" height="340"></li>
                </ul>
                <div class="salon-info">
                    <a href="/base.php" class="logo-info"></a>
                    <p>Автоцентр Колесо – крупнейший на Южном Урале автоцентр регионального формата.
Здесь представлены автомобили популярных мировых брендов, а также сопутствующий комплекс товаров и услуг: от предпродажной подготовки и сервисного обслуживания,
до кредитования, лизинга и страхования.
На площади 20 000 кв. м представлено более 500 новых
и с пробегом автомобилей.
</p>
                </div>
            </div>
            </div>
        </section>
        <section class="cars_showroom" id="cars_showroom">
            <div class="center">
            <h1 class="title car_showroom-title">Автосалоны</h1>
                <ul class="list car_showroom-list">
                    <li class="car_showroom-item">
                        <a href="./jaec.php" class="link">
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
                        <a href="./omoda.php" class="link">
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
                            <a href="./geely.php" class="link">
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
                        <button id="openModalBtn" type="button" class="button main">Узнать больше</button>
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
                    <img src="./images/use_car1.1.jpg" class="img-cars" alt="use_car" height="240" width="360">
                    <img src="./images/use_car1.2.jpg" class="img-cars second" alt="use_car"height="240" width="360">
                    <h2 class="cars-title">Ваз 1111</h2>
                    <p class="subhead-cars">бензин 53 л.с</p>
                    <h3 class="un-title-cars">767 000 р.</h3>
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
            <ul class="used-cars-list">
            </ul>

            </div>
        </section>
        <section class="center-services" id="services">
            <h1 class="title Services-title">Услуги</h1>
            <ul class="list Services-list">
                <li class="Services-item credit">
                    <a href="./credit.php" class="link">
                        <img src="./images/xz1.png" class="img-service" alt="" width="223" height="190">
                        <h3 class="title title-servs credit">АвтоКредит</h3>
                        <p class="subhead-servs credit">Расчитать<br> ежемесечный платеж</p>
                        <button type="button" class="button service-button ">Подробнее</button>
                    </a>
                </li>
                <li class="Services-item Trade-In">
                    <a href="./trade.php" class="link">
                        <img src="./images/xz2.png" class="img-service" alt="" width="223" height="190">
                        <h3 class="title title-servs">Trade-In</h3>
                        <p class="subhead-servs Trade-In">Обменять свой автомобиль на новый</p>
                    <button type="button" class="button service-button Trade-In">Подробнее</button>
                    </a>
                </li>
                <li class="Services-item lising">
                    <a href="./lising.php" class="link">
                        <img src="./images/xz3.png" class="img-service" alt="" width="223" height="190">
                        <h3 class="title title-servs">Лизинг</h3>
                        <p class="subhead-servs">Индивидуальное предложение аренды</p>
                        <button type="button" class="button service-button lising">Подробнее</button>
                    </a>
                </li>
            </ul>
        </section>
        <section id="uslugi" >
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
                        <button type="button" class="button main serv" onclick="submitApplication('Автомойка')">Подать заявку</button>
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
                        <button type="button" class="button main serv" onclick="submitApplication('Детейлинг')">Подать заявку</button>
                    </div>
                </li>
                <li class="auto-service-item tire-fitting">
                    <div class="text-auto-service">
                        <h2 class="auto-service-subtitle">Сервсиное обслуживание</h2>
                        <p class="auto-service-subhead">
                            Профессиональный сервис.<br> 
                            Необходимое условие для безопасной эксплуатации автомобиля – регулярная проверка и изменение узлов и агрегатов. Каждое время года требует определенных технических характеристик от автомобильных комплектующих для гарантии надежности и безопасности на дороге.
                        </p>
                        <button type="button" class="button main serv" onclick="submitApplication('Сервисное обслуживание')">Подать заявку</button>
                    </div>
                </li>
                </ul>
            </div>
        </section>
<section class="hero-bg second" id="reg">
            <?php if (!isset($_SESSION['user_id'])): ?>
                <form class="form-pos" method="POST">
                    <h1 class="form-title">Вход</h1>
                    
                    <?php if (!empty($errors) && isset($_POST['login'])): ?>
                        <div class="error-message">
                            <?php foreach ($errors as $error): ?>
                                <p><?php echo htmlspecialchars($error); ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <ul class="list form-field">
                        <li class="item-list">
                            <label class="item">
                                <input type="email" name="email" class="form-input" placeholder="" required>
                                <span class="form-label">E-mail</span>
                            </label>
                        </li>
                        <li class="item-list">
                            <label class="item">
                                <input type="password" name="password" class="form-input" placeholder=" " required>
                                <span class="form-label">Пароль</span>
                            </label>
                        </li>
                    </ul>
                    <button type="submit" class="button-form" name="login">Войти</button>
                    <a href="./registration.php" class="registration">Регистрация</a>
                </form>
            <?php else: ?>
                <div style="text-align: center; padding: 50px 0;">
                    <h2>Вы уже авторизованы как <?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
                    <a href="?logout=1" class="button main" style="margin-top: 20px;">Выйти</a>
                </div>
            <?php endif; ?>
        </section>
    </main>
<footer>
<div class="bg-footer">
    <div class="center footer">
            <div class="info-down">
                <a href="/base.php" class="logo down"></a>
                <p> &copy; КолесоАвтоЦентр, 2024 <br>
                Все права защищены
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
                                <li class="footer-item">+7 (903) 362-11-67</li>
                                <li class="footer-item">koleso@mail.ru</li>
                            </ul>
                </li>
            </ul>
            <ul class="list media-list">    
                <li class="media-item">
                    <a href="https://t.me/+o7Cx3DfMJZJlMzYy" aria-label="Telegram">
                        <svg class="svg-social" width="20" height="20">
                            <use href="./images/symbol-defs.svg#icon-icon-send"></use>
                        </svg>
                    </a>
                </li>
                <li class="media-item">
                    <a href="https://vk.com/club230755090" aria-label="VK">
                        <svg class="svg-social" width="20" height="20">
                            <use href="./images/symbol-defs.svg#icon-vk-svgrepo-com"></use>
                        </svg>
                    </a>
                </li>
            </ul>
    </div>
</div>
</footer>
    
    <!-- Модальное окно добавления машины -->
    <div id="addCarModal" class="add-car-modal-overlay">
        <div class="add-car-modal-content">
            <button class="add-car-close-modal">&times;</button>
            <h2 style="text-align: center; margin-bottom: 20px;">Добавить новую машину</h2>
            
            <form id="addCarForm" class="hidden-form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="add_car" value="1">
                <div class="add-car-form-group">
                    <label>Название модели:</label>
                    <input type="text" id="carTitle" required class="add-car-form-input">
                </div>
                
                <div class="add-car-form-group">
                    <label>Характеристики:</label>
                    <input type="text" id="carSpecs" required class="add-car-form-input">
                </div>
                
                <div class="add-car-form-group">
                    <label>Цена:</label>
                    <input type="text" id="carPrice" required class="add-car-form-input">
                </div>
                
                <div class="add-car-form-group">
                    <label>Год:</label>
                    <input type="text" id="carYear" required class="add-car-form-input">
                </div>
                
                <div class="add-car-form-group">
                    <label>Описание:</label>
                    <input type="text" id="carDiscription" required class="add-car-form-input">
                </div>
                
                <div class="add-car-form-group">
                    <label>Основное изображение:</label>
                    <input type="file" id="mainImage" accept="image/*" required class="add-car-form-input">
                    <div id="mainImagePreview" class="add-car-image-preview"></div>
                </div>
                
                <div class="add-car-form-group">
                    <label>Дополнительное изображение:</label>
                    <input type="file" id="secondaryImage" accept="image/*" required class="add-car-form-input">
                    <div id="secondaryImagePreview" class="add-car-image-preview"></div>
                </div>
                
                <input type="text"    name="carTitle"       id="carTitle"       required>
                <input type="text"    name="carSpecs"       id="carSpecs"       required>
                <input type="text"    name="carPrice"       id="carPrice"       required>
                <input type="number"  name="carYear"        id="carYear"        required>
                <textarea             name="carDescription" id="carDescription" required></textarea>
                <input type="file"    name="mainImage"      id="mainImage"      accept="image/*" required>
                <input type="file"    name="secondaryImage" id="secondaryImage" accept="image/*" required>
                <button type="submit" class="button main">Добавить машину</button>
            </form>
        </div>
    </div>
        <!-- Модальное окно просмотра машины -->
    <div id="viewCarModal" class="view-car-modal-overlay">
        <div class="view-car-modal-content">
            <div class="view-car-modal-image-container" >
                <img src="" alt="" class="view-car-modal-image view-car-main-image">
                <img src="" alt="" class="view-car-modal-image view-car-secondary-image">
            </div>
            <div class="view-car-modal-info">
                <h2></h2>
                <p><strong>Цена:</strong> <span class="view-car-price"></span></p>
                <p><strong>Год:</strong> <span class="view-car-year"></span></p>
                <p><strong>Характеристики:</strong> <span class="view-car-specs"></span></p>
                <p><strong>Описание:</strong> <span class="view-car-description"></span></p>
            </div>
        </div>
    </div>
    
<script>

    // Открытие модального окна добавления машины
    document.getElementById('addCarBtn').addEventListener('click', function() {
        document.getElementById('addCarModal').style.display = 'flex';
    });

    // Закрытие модального окна добавления
    document.querySelector('#addCarModal .add-car-close-modal').addEventListener('click', function() {
        document.getElementById('addCarModal').style.display = 'none';
    });
        
    // Закрытие по клику вне окон
    document.getElementById('addCarModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
        }
    });

    // Превью изображений
    document.getElementById('mainImage').addEventListener('change', function(e) {
        previewImage(e.target, 'mainImagePreview');
    });

    document.getElementById('secondaryImage').addEventListener('change', function(e) {
        previewImage(e.target, 'secondaryImagePreview');
    });

    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        preview.innerHTML = '';
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxHeight = '150px';
                img.style.maxWidth = '100%';
                preview.appendChild(img);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Функция показа модального окна машины
    function showCarModal(mainImage, secondaryImage, title, price, year, specs, description) {
        const modal = document.getElementById('viewCarModal');
        const content = modal.querySelector('.view-car-modal-content');
        
        content.querySelector('.view-car-main-image').src = mainImage;
        content.querySelector('.view-car-main-image').alt = title;
        content.querySelector('.view-car-secondary-image').src = secondaryImage;
        content.querySelector('.view-car-secondary-image').alt = title;
        content.querySelector('h2').textContent = title;
        content.querySelector('.view-car-price').textContent = price;
        content.querySelector('.view-car-year').textContent = year;
        content.querySelector('.view-car-specs').textContent = specs;
        content.querySelector('.view-car-description').textContent = description;
        
        modal.style.display = 'flex';
    }

    // Закрытие по клику вне окон
    document.getElementById('viewCarModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
        }
    });

    // Обработчики для существующих кнопок "Узнать больше"
document.querySelectorAll('.main-cars-item .button.main').forEach(button => {
    button.addEventListener('click', function(e) {
        // Проверяем, не является ли это кнопкой добавления машины
        if (this.id === 'addCarBtn' || this.classList.contains('serv')) return;
        
        e.preventDefault();
        const carItem = this.closest('.main-cars-item');
        const title = carItem.querySelector('.cars-title').textContent;
        const price = carItem.querySelector('.un-title-cars').textContent;
        const year = carItem.querySelector('.car-year') ? carItem.querySelector('.car-year').textContent.replace('Год выпуска: ', '') : 'Не указан';
        const specs = carItem.querySelector('.subhead-cars').textContent;
        const description = carItem.querySelector('.car-description') ? carItem.querySelector('.car-description').textContent : 'Описание отсутствует';
        const mainImage = carItem.querySelector('.img-cars').src;
        const secondaryImage = carItem.querySelector('.img-cars.second').src;
        
        showCarModal(mainImage, secondaryImage, title, price, year, specs, description);
    });
});
    </script>
    
       <script>
           // Функция для показа уведомления
    function showNotification(message, isError = false) {
        const notification = document.getElementById('notification');
        notification.textContent = message;
        notification.className = isError ? 'notification error' : 'notification';
        notification.style.display = 'block';
        
        // Автоматическое скрытие через 3 секунды
        setTimeout(() => {
            notification.style.display = 'none';
        }, 3000);
    }
     // Функция для отправки заявки через AJAX
    function submitApplication(applicationType, carModel = null) {
        if (!<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>) {
            showNotification('Для подачи заявки необходимо авторизоваться', true);
            document.getElementById('btn4').click();
            return;
        }
        // Создаем FormData из формы
        const formData = new FormData(document.getElementById('applicationForm'));
           
           // Отправляем данные через AJAX
        fetch(window.location.href, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Показываем уведомление об успехе
            showNotification(`Заявка на '${applicationType}'${carModel ? ' (Модель: ' + carModel + ')' : ''} успешно отправлена!`);
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Произошла ошибка при отправке заявки', true);
        });
    }
       
    // Функция для отправки заявки
function submitApplication(applicationType, carModel = null) {
    if (!<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>) {
        showNotification('Для подачи заявки необходимо авторизоваться', true);
        document.getElementById('btn4').click();
        return;
    }
    
        // Устанавливаем значения в скрытую форму
        document.getElementById('applicationTypeInput').value = applicationType;
        document.getElementById('carModelInput').value = carModel || '';
    
    // Отправляем форму
    document.getElementById('applicationForm').submit();
}
// Обработчики для кнопок "Оставить заявку" на автомобилях
    document.querySelectorAll('.button.secondary').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const carItem = this.closest('.main-cars-item');
            const carModel = carItem.querySelector('.cars-title').textContent;
            submitApplication('Заявка на автомобиль', carModel);
        });
    });
           
    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            showNotification('<?php echo addslashes($error); ?>', true);
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($success_messages)): ?>
        <?php foreach ($success_messages as $message): ?>
            showNotification('<?php echo addslashes($message); ?>');
        <?php endforeach; ?>
    <?php endif; ?>       
           
</script> 
    

<script>
  // Навешиваем обработчики удаления после того, как весь DOM с .delete-car-btn уже встал
  document.querySelectorAll('.delete-car-btn').forEach(btn => {
    btn.addEventListener('click', function(){
      const li = this.closest('li.main-cars-item');
      const id = li.dataset.id;
      if (!confirm('Удалить эту машину?')) return;

      fetch('?delete_car_id=' + id, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => {
        if (res.ok) {
          li.remove();
          showNotification('Машина удалена');
        } else {
          showNotification('Ошибка при удалении', true);
        }
      });
    });
  });
</script>
    
    <script>
            // Ваши существующие скрипты для навигации и других функций
    const btn1 = document.getElementById('btn1');
    const btn2 = document.getElementById('btn2');
    const btn3 = document.getElementById('btn3');
    const btn4 = document.getElementById('btn4');
    const btn6 = document.getElementById('btn6');
    const section1 = document.getElementById('reg');
    const section2 = document.getElementById('info');
    const section3 = document.getElementById('cars_showroom');
    const section4 = document.getElementById('services');
    const section5 = document.getElementById('uslugi');

    btn1.addEventListener('click', () => {
        section2.scrollIntoView({ behavior: 'smooth' });
    });

    btn2.addEventListener('click', () => {
        section3.scrollIntoView({ behavior: 'smooth' });
    });

    btn3.addEventListener('click', () => {
        section4.scrollIntoView({ behavior: 'smooth' });
    });

    btn4.addEventListener('click', () => {
        section1.scrollIntoView({ behavior: 'smooth' });
    });
        
        btn6.addEventListener('click', () => {
        section5.scrollIntoView({ behavior: 'smooth' });
    });
    
    </script>
    
</body>
</html>