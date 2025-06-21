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
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }
    
    return $pdo;
}

// Получаем данные из таблицы zayavka
try {
    $pdo = getPDOConnection();
    $stmt = $pdo->query("SELECT * FROM zayavka ORDER BY zayavk_id DESC");
    $zayavki = $stmt->fetchAll();
} catch(PDOException $e) {
    $errors[] = "Ошибка при загрузке заявок: " . $e->getMessage();
    $zayavki = [];
}

// Обработка удаления заявки
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    try {
        $pdo = getPDOConnection();
        $stmt = $pdo->prepare("DELETE FROM zayavka WHERE zayavk_id = ?");
        $stmt->execute([$_GET['delete_id']]);
        $success_messages[] = "Заявка успешно удалена";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } catch(PDOException $e) {
        $errors[] = "Ошибка при удалении заявки: " . $e->getMessage();
    }
}

// Обработка изменения статуса на "Выполнено"
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['complete_id'])) {
    try {
        $pdo = getPDOConnection();
        $stmt = $pdo->prepare("UPDATE zayavka SET status = 'Выполнено' WHERE zayavk_id = ?");
        $stmt->execute([$_GET['complete_id']]);
        $success_messages[] = "Статус заявки изменен на 'Выполнено'";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } catch(PDOException $e) {
        $errors[] = "Ошибка при изменении статуса заявки: " . $e->getMessage();
    }
}

// Обработка изменения статуса на "В процессе"
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['inprogress_id'])) {
    try {
        $pdo = getPDOConnection();
        $stmt = $pdo->prepare("UPDATE zayavka SET status = 'В процессе' WHERE zayavk_id = ?");
        $stmt->execute([$_GET['inprogress_id']]);
        $success_messages[] = "Статус заявки изменен на 'В процессе'";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } catch(PDOException $e) {
        $errors[] = "Ошибка при изменении статуса заявки: " . $e->getMessage();
    }
}

// Обработка изменения статуса на "В обработке"
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['processing_id'])) {
    try {
        $pdo = getPDOConnection();
        $stmt = $pdo->prepare("UPDATE zayavka SET status = 'В обработке' WHERE zayavk_id = ?");
        $stmt->execute([$_GET['processing_id']]);
        $success_messages[] = "Статус заявки изменен на 'В обработке'";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } catch(PDOException $e) {
        $errors[] = "Ошибка при изменении статуса заявки: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Автоцетр Колесо - Заявки</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/modern-normalize/3.0.1/modern-normalize.css">
    <link rel="stylesheet" href="./css/2.css">
    <style>
        .zayavki-section {
            padding: 40px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .zayavki-table {
            width: 95%;
            max-width: 1200px;
            border-collapse: collapse;
            margin: 30px 0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 3px;
            overflow: hidden;
        }
        
        .zayavki-table thead tr {
            background-color: #ca2a39;
            color: white;
            text-align: left;
        }
        
        .zayavki-table th,
        .zayavki-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }
        
        .zayavki-table tbody tr:nth-of-type(even) {
            background-color: #f9f9f9;
        }
        
        .zayavki-table tbody tr:last-of-type {
            border-bottom: 2px solid #ca2a39;
        }
        
        .zayavki-table tbody tr:hover {
            background-color: #f1f1f1;
        }
        
        .action-btn {
            padding: 5px 10px;
            border-radius: 3px;
            text-decoration: none;
            font-size: 14px;
            margin: 2px;
            display: inline-block;
            color: white;
            border: none;
            cursor: pointer;
        }
        
        .inprogress-btn {
            background-color: #3498db;
        }
        
        .inprogress-btn:hover {
            background-color: #2980b9;
        }
        
        .delete-btn {
            background-color: #ca2a39;
        }
        
        .delete-btn:hover {
            background-color: #a72230;
        }
        
        .complete-btn {
            background-color: #2ecc71;
        }
        
        .complete-btn:hover {
            background-color: #27ae60;
        }
        
        .processing-btn {
            background-color: #f39c12;
        }
        
        .processing-btn:hover {
            background-color: #e67e22;
        }
        
        .status-new {
            color: #3498db;
            font-weight: bold;
        }
        
        .status-processing {
            color: #f39c12;
            font-weight: bold;
        }
        
        .status-inprogress {
            color: #9b59b6;
            font-weight: bold;
        }
        
        .status-completed {
            color: #2ecc71;
            font-weight: bold;
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
            overflow-x: auto;
        }
        
        .filter-section {
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .filter-select {
            padding: 5px 10px;
            border-radius: 3px;
            border: 1px solid #ddd;
        }
        
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 3px;
            text-align: center;
        }
        
        .error-message {
            background-color: #ffdddd;
            color: #d8000c;
        }
        
        .success-message {
            background-color: #ddffdd;
            color: #4f8a10;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-flex">
            <a href="/base.php" class="logo"></a>
        </div>
    </header>
    
    <main class="admin-only">
        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($success_messages)): ?>
            <div class="success-message">
                <?php foreach ($success_messages as $message): ?>
                    <p><?php echo htmlspecialchars($message); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <section class="zayavki-section">
            <h1>Поданные заявки</h1>
            <p>Просмотр и управление заявками</p>
            
            <div class="filter-section">
                <div>
                    <label for="zayavka-filter">Фильтр по типу заявки:</label>
                    <select id="zayavka-filter" class="filter-select">
                        <option value="">Все заявки</option>
                        <?php 
                        $types = array_unique(array_column($zayavki, 'zayavk'));
                        foreach ($types as $type) {
                            echo '<option value="'.htmlspecialchars($type).'">'.htmlspecialchars($type).'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="status-filter">Фильтр по статусу:</label>
                    <select id="status-filter" class="filter-select">
                        <option value="">Все статусы</option>
                        <option value="Новая">Новая</option>
                        <option value="В обработке">В обработке</option>
                        <option value="В процессе">В процессе</option>
                        <option value="Выполнено">Выполнено</option>
                    </select>
                </div>
            </div>
            
            <div class="table-container">
                <table class="zayavki-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Тип заявки</th>
                            <th>Фамилия</th>
                            <th>Имя</th>
                            <th>Отчество</th>
                            <th>Email</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($zayavki)): ?>
                            <tr>
                                <td colspan="8" style="text-align: center;">Нет данных о заявках</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($zayavki as $zayavka): 
                                $status = $zayavka['status'] ?? 'Новая';
                                $statusClass = 'status-new';
                                if ($status === 'В обработке') $statusClass = 'status-processing';
                                elseif ($status === 'В процессе') $statusClass = 'status-inprogress';
                                elseif ($status === 'Выполнено') $statusClass = 'status-completed';
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($zayavka['zayavk_id'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($zayavka['zayavk'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($zayavka['ln'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($zayavka['fn'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($zayavka['sn'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($zayavka['email'] ?? ''); ?></td>
                                <td class="<?php echo $statusClass; ?>">
                                    <?php echo htmlspecialchars($status); ?>
                                </td>
                                <td>
                                    <button onclick="if(confirm('Вы уверены, что хотите удалить эту заявку?')) window.location.href='?delete_id=<?php echo $zayavka['zayavk_id']; ?>'" 
                                            class="action-btn delete-btn">Удалить</button>
                                    
                                    <?php if ($status !== 'В обработке'): ?>
                                        <button onclick="if(confirm('Отметить заявку как в обработке?')) window.location.href='?processing_id=<?php echo $zayavka['zayavk_id']; ?>'" 
                                                class="action-btn processing-btn">В обработке</button>
                                    <?php endif; ?>
                                    
                                    <?php if ($status !== 'В процессе'): ?>
                                        <button onclick="if(confirm('Отметить заявку как в процессе')) window.location.href='?inprogress_id=<?php echo $zayavka['zayavk_id']; ?>'" 
                                                class="action-btn inprogress-btn">В процессе</button>
                                    <?php endif; ?>
                                    
                                    <?php if ($status !== 'Выполнено'): ?>
                                        <button onclick="if(confirm('Отметить заявку как выполненную?')) window.location.href='?complete_id=<?php echo $zayavka['zayavk_id']; ?>'" 
                                                class="action-btn complete-btn">Выполнено</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
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

    <script>
    // Фильтрация таблицы по типу заявки и статусу
    document.getElementById('zayavka-filter').addEventListener('change', function() {
        applyFilters();
    });
    
    document.getElementById('status-filter').addEventListener('change', function() {
        applyFilters();
    });
    
    function applyFilters() {
        const zayavkaFilter = document.getElementById('zayavka-filter').value.toLowerCase();
        const statusFilter = document.getElementById('status-filter').value.toLowerCase();
        const rows = document.querySelectorAll('.zayavki-table tbody tr');
        
        rows.forEach(row => {
            const zayavkaType = row.cells[1].textContent.toLowerCase();
            const status = row.cells[6].textContent.toLowerCase();
            
            const zayavkaMatch = zayavkaFilter === '' || zayavkaType.includes(zayavkaFilter);
            const statusMatch = statusFilter === '' || status.includes(statusFilter);
            
            if (zayavkaMatch && statusMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    </script>
</body>
</html>