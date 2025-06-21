<?php
session_start();

// Проверка авторизации и роли пользователя
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    header("Location: Rostic    's%20Academy.php");
    exit();
}

// Подключение к базе данных
require_once 'db_connect.php'; // Файл с подключением к БД

// Получение списка сотрудников
try {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare("SELECT e.employee_id, e.lname, e.name, e.sname, e.Dolzh, e.email, r.role_name 
                          FROM employees e 
                          JOIN roles r ON e.role_id = r.role_id
                          ORDER BY e.employee_id");
    $stmt->execute();
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Ошибка при получении данных пользователя: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пользователи | Rostic's Academy</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/icon.png" type="image/png">
    <style>
        .employees-section {
            padding: 40px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .employees-table {
            width: 95%; /* Можно изменить на фиксированную ширину, например 1200px */
            max-width: 1200px; /* Максимальная ширина таблицы */
            border-collapse: collapse;
            margin: 30px 0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .employees-table thead tr {
            background-color: #e30613;
            color: white;
            text-align: left;
        }
        
        .employees-table th,
        .employees-table td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
        
        .employees-table tbody tr:nth-of-type(even) {
            background-color: #f9f9f9;
        }
        
        .employees-table tbody tr:last-of-type {
            border-bottom: 2px solid #e30613;
        }
        
        .employees-table tbody tr:hover {
            background-color: #f1f1f1;
        }
        
        .action-btn {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            margin-right: 5px;
        }
        
        .edit-btn {
            background-color: #3498db;
            color: white;
        }
        
        .edit-btn:hover {
            background-color: #2980b9;
        }
        
        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }
        
        .delete-btn:hover {
            background-color: #c0392b;
        }
        
        .add-employee {
            display: inline-block;
            background-color: #2ecc71;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            margin-bottom: 20px;
            transition: background-color 0.3s;
        }
        
        .add-employee:hover {
            background-color: #27ae60;
        }
        
        .admin-only {
            max-width: 100%;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .table-container {
            width: 100%;
            overflow-x: auto; /* Добавляем горизонтальную прокрутку для мобильных устройств */
            display: flex;
            justify-content: center;
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
    <main class="admin-only">
        <section class="employees-section">
            <h1>Управление пользователями</h1>
            <p>Просмотр и редактирование данных пользоватей</p>
            <table class="employees-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Должность</th>
                        <th>Email</th>
                        <th>Права доступа</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($employee['employee_id']); ?></td>
                        <td><?php echo htmlspecialchars($employee['lname']); ?></td>
                        <td><?php echo htmlspecialchars($employee['name']); ?></td>
                        <td><?php echo htmlspecialchars($employee['sname']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Dolzh']); ?></td>
                        <td><?php echo htmlspecialchars($employee['email']); ?></td>
                        <td><?php echo htmlspecialchars($employee['role_name']); ?></td>
                        <td>
                            <a href="edit_employee.php?id=<?php echo $employee['employee_id']; ?>" class="action-btn edit-btn">Редактировать</a>
                            <a href="delete_employee.php?id=<?php echo $employee['employee_id']; ?>" class="action-btn delete-btn" onclick="return confirm('Вы уверены, что хотите удалить этого сотрудника?')">Удалить</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
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