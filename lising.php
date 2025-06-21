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

// Обработка отправки заявки на консультацию
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_consultation'])) {
    if (!isset($_SESSION['user_id'])) {
        $errors[] = "Для подачи заявки необходимо авторизоваться";
    } else {
        try {
            $pdo = getPDOConnection();
            
            // Подготавливаем данные для вставки
            $data = [
                'ln' => $_SESSION['user_ln'] ?? '',
                'fn' => $_SESSION['user_fn'] ?? '',
                'sn' => $_SESSION['user_sn'] ?? '',
                'zayavk' => 'Консультация по Лизингу',
                'status' => 'Новая',
                'email' => $_SESSION['user_email'] ?? '',
            ];
            
            // Вставляем заявку в базу данных
            $stmt = $pdo->prepare("INSERT INTO zayavka (ln, fn, sn, zayavk, status, email) 
                                   VALUES (:ln, :fn, :sn, :zayavk, :status, :email)");
            $stmt->execute($data);
            
            // Сохраняем сообщение в сессии и делаем редирект
            $_SESSION['success_message'] = "Заявка на консультацию по Лизингу успешно отправлена!";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Автоцетр Колесо - Лизинг</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/modern-normalize/3.0.1/modern-normalize.css">
    <link rel="stylesheet" href="./css/2.css">
    <link rel="stylesheet" href="./css/1.css">
    <style>
    
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
    <header>
        <div id="notification" class="notification"></div>

<!-- Скрытая форма для отправки заявки -->
<form id="consultationForm" class="hidden-form" method="POST">
    <input type="hidden" name="submit_consultation" value="1">
</form>
        <div class="header-flex">
            <a href="/chetko_site.html" class="logo"></a>
            <nav>
            </nav>
        </div>
    </header>
    <main>
        <section class="Hero lising">
            <div class="lisingbox">
                <h3 class="arbuz">Лизинговые предложения</h3>
                <button type="button" class="button mmm" onclick="submitConsultation()">Получить консультацию</button>
            </div>
        </section>
        <section class="something">
            <div class="smtbox1"></div>
            <div class="smtbox2">
                <h2><span>Авто</span> в аренду</h2>
                <p>В авто центре «Колесо» Вы сможете не только выбрать автомобиль для личного пользования, но и найти транспорт для Вашего бизнеса. Мы предоставляем юридическим лицам (предприятиям малого и среднего бизнеса) максимально выгодные и комфортные условия приобретения автомобиля в лизинг, предлагая как легковые, так и грузовые автомобили и специализированные автомобили известных производителей.</p></div>
        </section>
        <section class="privilige">
            <h2><span> Преимущества </span> и особенности</h2>
            <ul class="priviligeul">
                <li class="priviligeli">
                    <div class="priviligeimg i1"></div>
                    <h3>Гибкие условия</h3>
                    <p>Выгодная цена за счёт специальных условий
                        и партнёрских программ</p>
                </li>
                <li class="priviligeli">
                    <div class="priviligeimg i2"></div>
                    <h3>Разнообразие автомобилей</h3>
                    <p>Выбирайте из широкого ассортимента автомобилей,
                        включая седаны, внедорожники и гибриды</p>
                </li>
                <li class="priviligeli">
                    <div class="priviligeimg i3"></div>
                    <h3>Служба поддержки 24/7</h3>
                    <p>Вам нужна помощь? Наша служба поддержки клиентов
                        доступна круглосуточно</p>
                </li>
                <li class="priviligeli">
                    <div class="priviligeimg i4"></div>
                    <h3>Безопасные платежи</h3>
                    <p>Будьте уверены в безопасности 
                        ваших платежей. Мы используем 
                        новейшие технологии безопасности
                         для защиты ваших данных</p>
                </li>
            </ul>
        </section>
        <section class="banking">
            <button class="banknext">></button>
            <button class="banknext before"><</button>
            <h2><span>Банки</span><p>и партнеры</p></h2>
            <ul class="bankingbox d1">
                <li class="bankingli vtb" ></li>
                <li class="bankingli alpha" ></li>
                <li class="bankingli sber" ></li>
                <li class="bankingli expo" ></li>
            </ul>
            <ul class="bankingbox d2">
                <li class="bankingli psb" ></li>
                <li class="bankingli rshb" ></li>
                <li class="bankingli open" ></li>
                
            </ul>
        </section>
    </main>
<footer>
<div class="bg-footer">
    <div class="center footer">
            <div class="info-down">
                <a href="/chetko_site.html" class="logo down"></a>
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
</body>
<script>
const btn1 = document.getElementById('btn1');
const btn2 = document.getElementById('btn2');
const btn3 = document.getElementById('btn3');
const btn4 = document.getElementById('btn4');
const section1 = document.getElementById('reg');
const section2 = document.getElementById('info');
const section3 = document.getElementById('cars_showroom');
const section4 = document.getElementById('services');


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
</script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
        const bank = document.querySelector('.bankingbox.d1');
        const bank2 = document.querySelector('.bankingbox.d2');
        const closeButton = document.querySelector('.banknext');
        const closeButton2 = document.querySelector('.banknext.before');
        
        // Проверка всех элементов
        if (!bank || !bank2 || !closeButton || !closeButton2) {
            console.error('Один или несколько элементов не найдены! Проверьте классы элементов.');
            return;
        }

        // Обработчики для первой кнопки
        closeButton.addEventListener('click', function(e) {
            e.preventDefault();
            bank.classList.toggle('buttonbanktop');
            bank2.classList.toggle('buttonbankbottom');
        });

        // Обработчики для второй кнопки
        closeButton2.addEventListener('click', function(e) {
            e.preventDefault();
            bank.classList.toggle('buttonbanktop');
            bank2.classList.toggle('buttonbankbottom');
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

// Функция для отправки заявки на консультацию
function submitConsultation() {
    <?php if (isset($_SESSION['user_id'])): ?>
        // Если пользователь авторизован - отправляем форму
        document.getElementById('consultationForm').submit();
    <?php else: ?>
        // Если не авторизован - показываем уведомление
        showNotification('Для подачи заявки необходимо авторизоваться', true);
        // Перенаправляем на страницу авторизации через 3 секунды
        setTimeout(() => {
            window.location.href = '/base.php#reg';
        }, 3000);
    <?php endif; ?>
}

// Показываем сообщения об ошибках/успехе
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
</html>