<?php
session_start();

// Проверка авторизации и роли администратора
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    header("Location: Rostic's%20Academy.php");
    exit();
}

require_once 'db_connect.php';

// Получаем список сотрудников и результаты тестов
try {
    $pdo = getPDOConnection();
    
    // Запрос для получения списка сотрудников
    $employees_stmt = $pdo->prepare("
        SELECT e.employee_id, e.lname, e.name, e.sname, e.Dolzh, e.email, r.role_name 
        FROM employees e 
        JOIN roles r ON e.role_id = r.role_id
        ORDER BY e.employee_id
    ");
    $employees_stmt->execute();
    $employees = $employees_stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Запрос для получения результатов тестов
    $results_stmt = $pdo->prepare("
        SELECT 
            result_id,
            employee_id,
            test_name,
            test_date,
            score,
            max_score
        FROM test_results
        ORDER BY test_date DESC
    ");
    $results_stmt->execute();
    $test_results = $results_stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    die("Ошибка при получении данных: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Административная панель | Rostic's Academy</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/icon.png" type="image/png">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        
        .header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 10;
            z-index: 100;
        }
        
        .container_header {
            max-width: 1500px;
            max-height: 55px;
            margin: 0 auto;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .admin-container {
            max-width: 1800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
        }
        
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #e30613;
            padding-bottom: 15px;
        }
        
        .admin-title {
            color: #e30613;
            font-size: 2rem;
            margin: 0;
        }
        
        .admin-tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        
        .tab-btn {
            padding: 12px 20px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            color: #555;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }
        
        .tab-btn.active {
            color: #e30613;
            border-bottom: 3px solid #e30613;
        }
        
        .tab-btn:hover:not(.active) {
            color: #333;
            background-color: #f5f5f5;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        /* Стили для таблиц */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            table-layout: fixed;
        }
        
        .data-table th {
            background-color: #e30613;
            color: white;
            text-align: center;
            padding: 12px 15px;
            position: sticky;
            top: 0;
        }
        
        .data-table td {
            padding: 12px 0px;
            border-bottom: 1px solid #ddd;
            word-wrap: break-word;
        }
        
        .data-table tr:nth-of-type(even) {
            background-color: #f9f9f9;
        }
        
        .data-table tr:hover {
            background-color: #f1f1f1;
        }
        
        /* Стили для статусов */
        .passed {
            color: #2ecc71;
            font-weight: bold;
        }
        
        .failed {
            color: #e74c3c;
            font-weight: bold;
        }
        
        .percentage-cell {
            font-weight: bold;
        }
        
        .high-percentage {
            color: #2ecc71;
        }
        
        .medium-percentage {
            color: #f39c12;
        }
        
        .low-percentage {
            color: #e74c3c;
        }
        
        /* Кнопки действий */
        .action-btn {
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            margin-right: 5px;
            display: inline-block;
            text-align: center;
            min-width: 80px;
        }
        
        .edit-btn {
             background-color: white;
    color: #e30613;
    border: 2px solid #e30613;
        }
        
        .edit-btn:hover {
             background-color: white;
    color: #e30613;
    border: 2px solid #e30613;
        }
        
        .delete-btn {
            background-color: #e30613;
            color: white;
        }
        
        .delete-btn:hover {
            background-color: #e30613;
        }
        
        .no-data {
            text-align: center;
            padding: 40px;
            font-size: 1.2rem;
            color: #777;
        }
        
        /* Навигация */
        .nav ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        .nav li {
            margin: 0 15px;
        }
        
        .nav a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }
        
        .nav a:hover {
            color: #e30613;
        }
        
        .nav a.active {
            color: #e30613;
            font-weight: bold;
        }
        
        /* Аутентификация */
        .auth {
            display: flex;
            align-items: center;
        }
        
        .auth a {
            margin-left: 15px;
            text-decoration: none;
            color: #333;
        }
        
        .auth a:hover {
            color: #e30613;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
        }
        
        .user-name {
            margin-right: 15px;
        }
        
        .logout-btn {
            color: #e30613;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- Шапка с навигацией -->
    <header class="header">
        <div class="container_header">
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
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <div class="user-profile">
                        <span class="user-name"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        <a href="logout.php" class="logout-btn">Выйти</a>
                    </div>
                <?php } else { ?>
                    <a href="reg.php">Вход</a>
                    <a href="reg.php">Регистрация</a>
                <?php } ?>
            </div>
        </div>
    </header>

    <!-- Основное содержимое -->
    <main class="admin-container">
        <div class="admin-header">
            <h1 class="admin-title">Административная панель</h1>
        </div>
        
        <div class="admin-tabs">
            <button class="tab-btn active" data-tab="employees">Управление пользователями</button>
            <button class="tab-btn" data-tab="results">Результаты тестов</button>
        </div>
        
        <!-- Вкладка "Управление пользователями" -->
<div id="employees-tab" class="tab-content active">
    <div class="filters-container" style="margin-bottom: 20px;">
        <div style="display: flex; gap: 15px; margin-bottom: 15px;">
            <div>
                <label for="position-filter">Фильтр по должности:</label>
                <select id="position-filter" class="filter-select">
                    <option value="">Все должности</option>
                    <?php 
                    $positions = array_unique(array_column($employees, 'Dolzh'));
                    foreach ($positions as $position) {
                        echo '<option value="'.htmlspecialchars($position).'">'.htmlspecialchars($position).'</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="role-filter">Фильтр по роли:</label>
                <select id="role-filter" class="filter-select">
                    <option value="">Все роли</option>
                    <?php 
                    $roles = array_unique(array_column($employees, 'role_name'));
                    foreach ($roles as $role) {
                        echo '<option value="'.htmlspecialchars($role).'">'.htmlspecialchars($role).'</option>';
                    }
                    ?>
                </select>
            </div>
            <button id="reset-filters" style="padding: 5px 10px; background: #e30613; color: white; border: none; border-radius: 4px; cursor: pointer;">Сбросить фильтры</button>
        </div>
    </div>
    
    <?php if (empty($employees)) { ?>
        <div class="no-data">Нет данных о пользователях</div>
    <?php } else { ?>
        <table class="data-table" id="employees-table">
            <thead>
                <tr>
                    <th style="width: 5%" class="sortable" data-sort="employee_id">ID <span class="sort-icon">▼</span></th>
                    <th style="width: 15%" class="sortable" data-sort="lname">Фамилия <span class="sort-icon"></span></th>
                    <th style="width: 15%" class="sortable" data-sort="name">Имя <span class="sort-icon"></span></th>
                    <th style="width: 15%" class="sortable" data-sort="sname">Отчество <span class="sort-icon"></span></th>
                    <th style="width: 15%" class="sortable" data-sort="Dolzh">Должность <span class="sort-icon"></span></th>
                    <th style="width: 15%">Email</th>
                    <th style="width: 10%" class="sortable" data-sort="role_name">Роль <span class="sort-icon"></span></th>
                    <th style="width: 10%">Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee) { ?>
                <tr data-position="<?php echo htmlspecialchars($employee['Dolzh']); ?>" data-role="<?php echo htmlspecialchars($employee['role_name']); ?>">
                    <td><?php echo htmlspecialchars($employee['employee_id']); ?></td>
                    <td><?php echo htmlspecialchars($employee['lname']); ?></td>
                    <td><?php echo htmlspecialchars($employee['name']); ?></td>
                    <td><?php echo htmlspecialchars($employee['sname']); ?></td>
                    <td><?php echo htmlspecialchars($employee['Dolzh']); ?></td>
                    <td><?php echo htmlspecialchars($employee['email']); ?></td>
                    <td><?php echo htmlspecialchars($employee['role_name']); ?></td>
                    <td>
                        <a href="edit_employee.php?id=<?php echo $employee['employee_id']; ?>" class="action-btn edit-btn">Ред.</a>
                        <a href="delete_employee.php?id=<?php echo $employee['employee_id']; ?>" class="action-btn delete-btn" onclick="return confirm('Удалить пользователя?')">Удал.</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>
        
        <!-- Вкладка "Результаты тестов" -->
        <div id="results-tab" class="tab-content">
            
            <?php if (empty($test_results)) { ?>
                <div class="no-data">Нет данных о результатах тестирования</div>
            <?php } else { ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 10%">ID сотр.</th>
                            <th style="width: 20%">Тест</th>
                            <th style="width: 15%">Дата</th>
                            <th style="width: 8%">Баллы</th>
                            <th style="width: 10%">Макс.</th>
                            <th style="width: 10%">%</th>
                            <th style="width: 10%">Статус</th>
                            <th style="width: 12%">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($test_results as $result) { 
                            $percentage = $result['max_score'] > 0 ? round(($result['score'] / $result['max_score']) * 100) : 0;
                            $status = $percentage >= 70 ? 'passed' : 'failed';
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($result['result_id']); ?></td>
                            <td><?php echo htmlspecialchars($result['employee_id']); ?></td>
                            <td><?php echo htmlspecialchars($result['test_name']); ?></td>
                            <td><?php echo date('d.m.Y H:i', strtotime($result['test_date'])); ?></td>
                            <td><?php echo $result['score']; ?></td>
                            <td><?php echo $result['max_score']; ?></td>
                            <td class="percentage-cell <?php echo $percentage >= 70 ? 'high-percentage' : ($percentage >= 50 ? 'medium-percentage' : 'low-percentage'); ?>">
                                <?php echo $percentage; ?>%
                            </td>
                            <td class="<?php echo $status; ?>">
                                <?php echo ($status == 'passed') ? 'Пройден' : 'Не пройден'; ?>
                            </td>
                            <td>
                                <a href="edit_test_result.php?id=<?php echo $result['result_id']; ?>" class="action-btn edit-btn">Ред.</a>
                                <a href="delete_test_result.php?id=<?php echo $result['result_id']; ?>" class="action-btn delete-btn" onclick="return confirm('Удалить результат?')">Удал.</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </main>

    <!-- Подвал -->
    <footer>
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

    <script>
        // Переключение между вкладками
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Удаляем активный класс у всех кнопок и вкладок
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));
                    
                    // Добавляем активный класс текущей кнопке
                    this.classList.add('active');
                    
                    // Показываем соответствующую вкладку
                    const tabName = this.getAttribute('data-tab');
                    document.getElementById(`${tabName}-tab`).classList.add('active');
                });
            });
        });
        // Сортировка таблицы
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('employees-table');
    const headers = table.querySelectorAll('.sortable');
    let currentSort = {
        column: 'employee_id',
        direction: 'asc'
    };

    // Инициализация сортировки по ID по умолчанию
    sortTable(currentSort.column, currentSort.direction);

    headers.forEach(header => {
        header.addEventListener('click', function() {
            const column = this.dataset.sort;
            let direction = 'asc';
            
            if (currentSort.column === column) {
                direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
            }
            
            currentSort = { column, direction };
            sortTable(column, direction);
            updateSortIcons(column, direction);
        });
    });

    function sortTable(column, direction) {
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        
        rows.sort((a, b) => {
            const aValue = a.querySelector(`td:nth-child(${getColumnIndex(column)})`).textContent;
            const bValue = b.querySelector(`td:nth-child(${getColumnIndex(column)})`).textContent;
            
            // Для числовых колонок (ID)
            if (column === 'employee_id') {
                return direction === 'asc' 
                    ? parseInt(aValue) - parseInt(bValue)
                    : parseInt(bValue) - parseInt(aValue);
            }
            
            // Для текстовых колонок
            return direction === 'asc' 
                ? aValue.localeCompare(bValue)
                : bValue.localeCompare(aValue);
        });
        
        // Очищаем и перезаполняем tbody
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
        
        rows.forEach(row => {
            tbody.appendChild(row);
        });
    }

    function getColumnIndex(columnName) {
        const headers = table.querySelectorAll('th');
        for (let i = 0; i < headers.length; i++) {
            if (headers[i].dataset.sort === columnName) {
                return i + 1;
            }
        }
        return 1;
    }

    function updateSortIcons(column, direction) {
        headers.forEach(header => {
            const icon = header.querySelector('.sort-icon');
            if (header.dataset.sort === column) {
                icon.textContent = direction === 'asc' ? '▲' : '▼';
            } else {
                icon.textContent = '';
            }
        });
    }

    // Фильтрация таблицы
    const positionFilter = document.getElementById('position-filter');
    const roleFilter = document.getElementById('role-filter');
    const resetFilters = document.getElementById('reset-filters');
    
    positionFilter.addEventListener('change', filterTable);
    roleFilter.addEventListener('change', filterTable);
    
    resetFilters.addEventListener('click', function() {
        positionFilter.value = '';
        roleFilter.value = '';
        filterTable();
    });

    function filterTable() {
        const positionValue = positionFilter.value.toLowerCase();
        const roleValue = roleFilter.value.toLowerCase();
        
        const rows = table.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const rowPosition = row.dataset.position.toLowerCase();
            const rowRole = row.dataset.role.toLowerCase();
            
            const positionMatch = positionValue === '' || rowPosition.includes(positionValue);
            const roleMatch = roleValue === '' || rowRole.includes(roleValue);
            
            if (positionMatch && roleMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
});
    </script>
</body>
</html>