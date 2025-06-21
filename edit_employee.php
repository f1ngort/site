<?php
session_start();

// Проверка авторизации и роли пользователя
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    header("Location: Rostic's%20Academy.php");
    exit();
}

require_once 'db_connect.php';

// Получение ID сотрудника из URL
$employee_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($employee_id <= 0) {
    header("Location: employees.php");
    exit();
}

// Получение данных сотрудника
try {
    $pdo = getPDOConnection();
    
    // Получаем данные сотрудника
    $stmt = $pdo->prepare("SELECT * FROM employees WHERE employee_id = ?");
    $stmt->execute([$employee_id]);
    $employee = $stmt->fetch();
    
    if (!$employee) {
        header("Location: employees.php");
        exit();
    }
    
    // Получаем список ролей
    $roles = $pdo->query("SELECT * FROM roles")->fetchAll();
    
} catch (PDOException $e) {
    die("Ошибка при получении данных: " . $e->getMessage());
}

// Обработка формы
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Валидация данных
    $lname = trim($_POST['lname']);
    $name = trim($_POST['name']);
    $sname = trim($_POST['sname']);
    $Dolzh = trim($_POST['Dolzh']);
    $email = trim($_POST['email']);
    $role_id = (int)$_POST['role_id'];
    $password = trim($_POST['password']);
    
    if (empty($name)) {
        $errors[] = "Имя обязательно для заполнения";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Введите корректный email";
    }
    
    if (!empty($password) && strlen($password) < 8) {
        $errors[] = "Пароль должен содержать минимум 8 символов";
    }
    
    // Проверка уникальности email (кроме текущего сотрудника)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM employees WHERE email = ? AND employee_id != ?");
    $stmt->execute([$email, $employee_id]);
    if ($stmt->fetchColumn() > 0) {
        $errors[] = "Пользователь с таким email уже существует";
    }
    
    // Если ошибок нет - обновляем данные
    if (empty($errors)) {
        try {
            if (!empty($password)) {
                // Обновляем с паролем
                $stmt = $pdo->prepare("UPDATE employees SET lname = ?, name = ?, sname = ?, Dolzh = ?, email = ?, role_id = ?, password = ? WHERE employee_id = ?");
                $stmt->execute([$lname, $name, $sname, $Dolzh, $email, $role_id, $password, $employee_id]);
            } else {
                // Обновляем без пароля
                $stmt = $pdo->prepare("UPDATE employees SET lname = ?, name = ?, sname = ?, Dolzh = ?, email = ?, role_id = ? WHERE employee_id = ?");
                $stmt->execute([$lname, $name, $sname, $Dolzh, $email, $role_id, $employee_id]);
            }
            
            $success = true;
            // Обновляем данные в переменной $employee
            $employee['lname'] = $lname;
            $employee['name'] = $name;
            $employee['sname'] = $sname;
            $employee['Dolzh'] = $Dolzh;
            $employee['email'] = $email;
            $employee['role_id'] = $role_id;
            
        } catch (PDOException $e) {
            $errors[] = "Ошибка при обновлении данных: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование пользователя | Rostic's Academy</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/icon.png" type="image/png">
    <style>
        .edit-employee-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border: 2px solid #e30613;
        }
        
        .edit-employee-container h1 {
            color: #e30613;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border 0.3s;
        }
        
        .form-control:focus {
            border-color: #e30613;
            outline: none;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 25px;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .btn-primary {
            background-color: #e30613;
            color: white;
            border: none;
        }
        
        .btn-primary:hover {
            background-color: #c00511;
        }
        
        .btn-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
            margin-left: 10px;
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .form-actions {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Шапка с навигацией -->
    <header class="header fade-in">
        <div class="container">
            <div class="logo">
                <a href="Rostic's%20Academy.php">
                    <img src="images/logo.png" alt="Rostic's Academy" width="180">
                </a>
            </div>
            <nav class="nav">
                <ul>
                    <li><a href="Rostic's%20Academy.php">Главная</a></li>
                    <li><a href="Rostic's%20Academy.php#courses">Курсы</a></li>
                    <li><a href="Rostic's%20Academy.php#tests">Тесты</a></li>
                    <li><a href="documents.php">Документы</a></li>
                    <li><a href="career.php">Карьера</a></li>
                </ul>
            </nav>
            <div class="auth">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="user-profile">
                        <span class="user-name"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        <a href="logout.php" class="logout-btn">Выйти</a>
                    </div>
                <?php else: ?>
                    <a href="reg.php">Вход</a>
                    <a href="reg.php">Регистрация</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Основное содержимое -->
    <main>
        <div class="edit-employee-container">
            <h1>Редактирование пользователя</h1>
            
            <?php if ($success): ?>
                <div class="alert alert-success">
                    Данные пользователя успешно обновлены!
                </div>
            <?php endif; ?>
            
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label for="lname">Фамилия</label>
                    <input type="text" id="lname" name="lname" class="form-control" 
                           value="<?php echo htmlspecialchars($employee['lname'] ?? ''); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" id="name" name="name" class="form-control" 
                           value="<?php echo htmlspecialchars($employee['name'] ?? ''); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="sname">Отчество</label>
                    <input type="text" id="sname" name="sname" class="form-control" 
                           value="<?php echo htmlspecialchars($employee['sname'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="Dolzh">Должность</label>
                    <input type="text" id="Dolzh" name="Dolzh" class="form-control" 
                           value="<?php echo htmlspecialchars($employee['Dolzh'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" 
                           value="<?php echo htmlspecialchars($employee['email'] ?? ''); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="role_id">Роль</label>
                    <select id="role_id" name="role_id" class="form-control" required>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?php echo $role['role_id']; ?>" 
                                <?php echo $role['role_id'] == ($employee['role_id'] ?? 0) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($role['role_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="password">Новый пароль (оставьте пустым, чтобы не менять)</label>
                    <input type="password" id="password" name="password" class="form-control">
                    <small class="text-muted">Минимум 8 символов</small>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <a href="employees.php" class="btn btn-secondary">Отмена</a>
                </div>
            </form>
        </div>
    </main>

    <!-- Подвал -->
    <footer class="fade-in">
        <div class="container">
            <div class="footer-links">
                <a href="about.php">О проекте</a>
                <a href="contacts.php">Контакты</a>
                <a href="privacy.php">Политика конфиденциальности</a>
            </div>
            <div class="social">
                <a href="https://vk.com/rostics_official?trackcode=3317ac9acONU_xABdQuVI_QWyeIfxqk4rp_FSpD0sF9xehbvCLw" target="_blank" aria-label="VK">
                    <img src="images/vk.png" alt="VK">
                </a>
                <a href="https://www.youtube.com/channel/UCPX0Uf4FnchKvGnSj-oeFUA" target="_blank" aria-label="YouTube">
                    <img src="images/youtube.png" alt="YouTube">
                </a>
                <a href="https://t.me/rostic_kfc" target="_blank" aria-label="Telegram">
                    <img src="images/telegram.png" alt="Telegram">
                </a>
            </div>
            <p>© 2025 Rostic's Academy. Все права защищены.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>