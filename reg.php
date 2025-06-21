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
                    PDO::ATTR_PERSISTENT => true // Используем постоянное подключение
                ]
            );
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }
    
    return $pdo;
}

// Обработка данных формы регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    try {
        $pdo = getPDOConnection();

        // Получение данных из формы
        $ln = trim($_POST['ln']);
        $fn = trim($_POST['fn']);
        $sn = trim($_POST['sn']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm'];
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
        
        if ($password !== $confirm_password) {
            $errors[] = "Пароли не совпадают";
        }
        
        if (!isset($_POST['agree-terms'])) {
            $errors[] = "Необходимо согласие с условиями использования";
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
            $stmt = $pdo->prepare("INSERT INTO users (ln, fn, sn, email, password, role_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$ln, $fn, $sn, $email, $password, $role_id]);
            
            // Успешная регистрация
            $success_messages[] = "Регистрация прошла успешно! Теперь вы можете войти в систему.";
            $_POST = array(); // Очищаем данные формы
        }
    } catch(PDOException $e) {
        $errors[] = "Ошибка базы данных: " . $e->getMessage();
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
                $_SESSION['user_id'] = $user['employee_id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role_id'];
                    header("Location: Rostic's%20Academy.php");
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
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Автоцетр Колесо - Регистрация</title>
    <link rel="stylesheet" href="stylereg.css">
    <link rel="icon" href="images/icon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #c3e6cb;
        }
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <!-- Шапка -->
    <header class="site-header">
        <div class="header-container">
            <div class="logo-container">
                <a href="Rostic's%20Academy.php">
                <img src="images/logo.png" alt="Rostic's Academy Logo" class="logo">
                </a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="Rostic's%20Academy.php">ГЛАВНАЯ</a></li>
                    <li><a href="Rostic's%20Academy.php#courses">КУРСЫ</a></li>
                    <li><a href="Rostic's%20Academy.php#tests">ТЕСТЫ</a></li>
                    <li><a href="documents.php">ДОКУМЕНТЫ</a></li>
                    <li><a href="career.php">КАРЬЕРА</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Основное содержимое -->
    <div class="main-content">
        <div class="auth-container">
            <div class="auth-tabs">
                <button class="tab-btn active" data-tab="login">Вход</button>
                <button class="tab-btn" data-tab="register">Регистрация</button>
            </div>

            <!-- Форма входа -->
            <form id="login-form" class="auth-form active" method="post">
                <h2>Вход в аккаунт</h2>
                <?php if (!empty($errors) && isset($_POST['login'])): ?>
                    <div class="error-message">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="login-email">Email</label>
                    <input type="email" id="login-email" name="email" required placeholder="Введите ваш email" value="<?php echo isset($_POST['email']) && isset($_POST['login']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="login-password">Пароль</label>
                    <input type="password" id="login-password" name="password" required placeholder="Введите пароль">
                    <a href="#" class="forgot-password">Забыли пароль?</a>
                </div>
                <button type="submit" class="auth-btn" name="login">Войти</button>
                <div class="social-login">
                    <p>Или войдите через:</p>
                    <div class="social-icons">
                        <button type="button" class="social-btn google">
                            <img src="images/google.png" alt="Google">
                        </button>
                        <button type="button" class="social-btn vk">
                            <img src="images/vkor.png" alt="VK">
                        </button>
                    </div>
                </div>
            </form>

            <!-- Форма регистрации -->
<form id="register-form" class="auth-form" method="post">
    <h2>Создать аккаунт</h2>
    <?php if (!empty($success_messages)): ?>
        <div class="success-message">
            <?php foreach ($success_messages as $message): ?>
                <p><?php echo htmlspecialchars($message); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($errors) && isset($_POST['register'])): ?>
        <div class="error-message">
            <?php foreach ($errors as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <label for="register-lname">Фамилия</label>
        <input type="text" id="register-lname" name="lname" required placeholder="Ваша фамилия" value="<?php echo isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : ''; ?>">
    </div>
    
    <div class="form-group">
        <label for="register-name">Имя</label>
        <input type="text" id="register-name" name="name" required placeholder="Ваше имя" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
    </div>
    
    <div class="form-group">
        <label for="register-sname">Отчество</label>
        <input type="text" id="register-sname" name="sname" placeholder="Ваше отчество" value="<?php echo isset($_POST['sname']) ? htmlspecialchars($_POST['sname']) : ''; ?>">
    </div>
    
    <div class="form-group">
        <label for="register-dolzh">Должность</label>
        <input type="text" id="register-dolzh" name="Dolzh" placeholder="Ваша должность" value="<?php echo isset($_POST['Dolzh']) ? htmlspecialchars($_POST['Dolzh']) : ''; ?>">
    </div>
    
    <div class="form-group">
        <label for="register-email">Email</label>
        <input type="email" id="register-email" name="email" required placeholder="Введите email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
    </div>
    <div class="form-group">
        <label for="register-password">Пароль</label>
        <input type="password" id="register-password" name="password" required placeholder="Придумайте пароль">
        <div class="password-hint">Пароль должен содержать минимум 8 символов</div>
    </div>
    <div class="form-group">
        <label for="register-confirm">Подтвердите пароль</label>
        <input type="password" id="register-confirm" name="confirm" required placeholder="Повторите пароль">
    </div>
    <div class="form-group checkbox">
        <input type="checkbox" id="agree-terms" name="agree-terms" required <?php echo isset($_POST['agree-terms']) ? 'checked' : ''; ?>>
        <label for="agree-terms">Я согласен с <a style="color: #e30613" href="#">условиями использования</a></label>
    </div>
    <button type="submit" class="auth-btn" name="register">Зарегистрироваться</button>
</form>
        </div>
    </div>

    <!-- Подвал -->
    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-links">
                <ul>
                    <li><a href="about.php">О ПРОЕКТЕ</a></li>
                    <li><a href="contacts.php">КОНТАКТЫ</a></li>
                    <li><a href="privacy.php">ПОЛИТИКА КОНФИДЕНЦИАЛЬНОСТИ</a></li>
                </ul>
            </div>
            <div class="social-links">
                <a href="https://vk.com/rostics_official?trackcode=3317ac9acONU_xABdQuVI_QWyeIfxqk4rp_FSpD0sF9xehbvCLw" target="_blank" aria-label="VK">
                    <img src="images/vk.png" alt="VK" width="30px">
                </a>
                <a href="https://www.youtube.com/channel/UCPX0Uf4FnchKvGnSj-oeFUA" target="_blank" aria-label="YouTube">
                    <img src="images/youtube.png" alt="YouTube" width="30px">
                </a>
                <a href="https://t.me/rostic_kfc" target="_blank" aria-label="Telegram">
                    <img src="images/telegram.png" alt="Telegram" width="30px">
                </a>
            </div>
            <div class="copyright">
                <p>© 2025 Roctic's Academy. Все права защищены.</p>
            </div>
        </div>
    </footer>

    <script>
        // Переключение между вкладками Вход/Регистрация
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-btn');
            const authForms = document.querySelectorAll('.auth-form');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Удаляем активный класс у всех кнопок и форм
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    authForms.forEach(form => form.classList.remove('active'));
                    
                    // Добавляем активный класс текущей кнопке
                    this.classList.add('active');
                    
                    // Показываем соответствующую форму
                    const tabName = this.getAttribute('data-tab');
                    document.getElementById(`${tabName}-form`).classList.add('active');
                });
            });

            // Автоматическое переключение на вкладку входа после успешной регистрации
            <?php if (!empty($success_messages)): ?>
                document.querySelector('.tab-btn[data-tab="login"]').click();
            <?php endif; ?>
        });
    </script>
</body>
</html>