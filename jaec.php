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
                'zayavk' => 'Желает приобрести JAECCO J7',
                'status' => 'Новая',
                'email' => $_SESSION['user_email'] ?? '',
            ];
            
            // Вставляем заявку в базу данных
            $stmt = $pdo->prepare("INSERT INTO zayavka (ln, fn, sn, zayavk, status, email) 
                                   VALUES (:ln, :fn, :sn, :zayavk, :status, :email)");
            $stmt->execute($data);
            
            // Сохраняем сообщение в сессии и делаем редирект
            $_SESSION['success_message'] = "Заявка на консультацию по тест драйву успешно отправлена!";
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
    <title>Автоцетр Колесо - JAECOO</title>
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
        <!-- Уведомление -->
<div id="notification" class="notification"></div>

<!-- Скрытая форма для отправки заявки -->
<form id="consultationForm" class="hidden-form" method="POST">
    <input type="hidden" name="submit_consultation" value="1">
</form>
        <div class="header-flex">
            <a href="/base.php" class="logo"></a>
        </div>
    </header>
    <main>
        <section class="Hero jaecoo">
            <h2>Евразия JAECOO</h2>
        </section>
        <section class="Description">
            <h2>О Бренде</h2>
            <div class="DescriptionH2border"></div>
            <p class="DescriptionText">
                JAECOO – бренд просторных и комфортных кроссоверов, выделяющихся среди городского потока. С помощью системы полного привода и адаптивной подвески автомобили уверенно чувствуют себя как в городе, так и за его пределами, на грунтовых дорогах и даже на заснеженной местности.
                <br>JAECOO – не просто автомобиль, это ваш надежный спутник, который поможет реализовать все задуманное. С ним вы можете уверенно исследовать мир бездорожья! <br>
                Оцените возможности мощного JAECOO вместе с Автосалоном Евразия! Ждем Вас в нашем шоуруме.
            </p>
            <p class="Descriptionlink">Телефон <span>+73532405000</span></p>
            <div class="DescriptionPhoto">
                <ul class="DescriptionUl">
                    <li><img src="./images/jaecoo_1.1.jpg" alt=""></li>
                    <li><img src="./images/omoda_2.jpg" alt="" width="300" height="320"></li>
                    <li><img src="./images/jaecoo_1.2.jpg" alt=""></li>
                </ul>
            </div>
        </section>
        <section class="Catalog jaecoo">
            <div>
                <h3>J7</h3>
                <p>От 2 699 900 ₽</p>
                <p class="CatalogText">Жить по-настоящему - жить так, чтобы выходить из собственной тени, быть победителем, потому что именно ты знаешь правила игры</p>
               <button class="FormButton" type="button" onclick="submitConsultation()">Записаться на тест-драйв</button>
            </div>
        </section>
    </main>
<footer>
<div class="bg-footer">
    <div class="center footer">
            <div class="info-down">
                <a href="/base.php" class="logo down"></a>
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