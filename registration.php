<?php
session_start();

// Конфигурация базы данных
define('DB_HOST', 'localhost');
define('DB_NAME', 'cars');
define('DB_USER', 'root');
define('DB_PASS', '');

$errors = [];
$success = false;

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
                    PDO::ATTR_PERSISTENT => true // Используем постоянное подключение
                ]
            );
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }
    
    return $pdo;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    try {
        $pdo = getPDOConnection();

        // Получение данных из формы
        $ln = trim($_POST['ln']?? '');
        $fn = trim($_POST['fn']?? '');
        $sn = trim($_POST['sn']?? '');
        $email = trim($_POST['email']?? '');
        $password = $_POST['password']?? '';
        $confirm = $_POST['confirm']?? '';
        $role_id = 2; //  Роль по умолчанию для новых пользователей

        // Валидация данных
        if (empty($fn)) {
            $errors[] = "Имя обязательно для заполнения";
        }
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Введите корректный email";
        }
        
        if (strlen($password) < 8) {
            $errors[] = "Пароль должен содержать минимум 8 символов";
        }
        
        if ($password !== $confirm) {
            $errors[] = "Пароли не совпадают";
        }

        // Проверка, существует ли email в базе
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) {
            $errors[] = "Пользователь с таким email уже зарегистрирован";
        }

        // Если ошибок нет - регистрируем пользователя
        if (empty($errors)) {
            // Вставка данных в базу
            $stmt = $pdo->prepare("INSERT INTO users (ln, fn, sn, email, password, confirm, role_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$ln, $fn, $sn, $email, $password, $confirm,  $role_id]);
            
            $success = true;
            $_SESSION['success_message'] = "Регистрация прошла успешно! Теперь вы можете авторизоваться перейдите на главную страницу";
            header("Location: ".$_SERVER['PHP_SELF']);
            $_POST = array(); // Очищаем данные формы
            exit();
        }
    } catch(PDOException $e) {
        $errors[] = "Ошибка базы данных: " . $e->getMessage();
    }
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
</head>
<body>
    <header>
        <div class="header-flex">
            <a href="/base.php" class="logo"></a>
                
        </div>
    </header>
    <main>
        <section class="hero-bg second" id="reg">
            <form class="form-pos" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="success-message">
                        <p><?php echo htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?></p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($errors) && isset($_POST['register'])): ?>
                    <div class="error-message">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <h1 class="form-title">Регистрация</h1>
                <ul class="list form-field">
                    <li class="item-list">
                        <label class="item">
                            <input type="text" id="register-ln" name="ln" class="form-input" placeholder=" "
                            value="<?php echo isset($_POST['ln']) ? htmlspecialchars($_POST['ln']) : ''; ?>">
                            <span class="form-label">Фамилия</span>
                        </label>
                    </li>                    
                    <li class="item-list">
                        <label class="item">
                            <input type="text" id="register-fn" name="fn" class="form-input" placeholder=" "
                            value="<?php echo isset($_POST['fn']) ? htmlspecialchars($_POST['fn']) : ''; ?>">
                            <span class="form-label">Имя</span>
                        </label>
                    </li>      
                    <li class="item-list">
                        <label class="item">
                            <input type="text" id="register-sn" name="sn" class="form-input" placeholder=" "
                            value="<?php echo isset($_POST['sn']) ? htmlspecialchars($_POST['sn']) : ''; ?>">
                            <span class="form-label">Отчество</span>
                        </label>
                    </li>                    
                    <li class="item-list">
                        <label class="item">
                            <input type="email" id="register-email" name="email" class="form-input" placeholder=" "
                            value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                            <span class="form-label">E-mail</span>
                        </label>
                    </li>                   
                    <li class="item-list">
                        <label class="item">
                            <input type="password" id="register-password" name="password" class="form-input" placeholder=" ">
                            <span class="form-label">Пароль</span>
                        </label>
                        
                        <li class="item-list">
                        <label class="item">
                            <input type="confirm" id="register-confirm" name="confirm" class="form-input" placeholder=" " required>
                            <span class="form-label">Подтвердите пароль</span>
                        </label>
                    </li>                 
                </ul>
                <button type="submit" class="button-form" name="register">Зарегистрироваться</button> 
                <body>
</body>
            </form>
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
</body>
</html>