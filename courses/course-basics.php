<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROSTIC'S ACADEMY - Основы работы в Ростикс</title>
    <link rel="stylesheet" href="../style.css">
     <link rel="icon" href="../images/icon.png" type="image/x-icon">
</head>
<body>
    <!-- Шапка с логотипом и навигацией -->
   <header class="header fade-in">
        <div class="container">
            <div class="logo">
                <a href="../Rostic's%20Academy.php">
                    <img src="../images/logo.png" alt="Rostic's Academy" width="180">
                </a>
            </div>
            <nav class="nav">
                <ul>
                     <li><a href="../Rostic's%20Academy.php">Главная</a></li>
                    <li><a href="../Rostic's%20Academy.php#courses">Курсы</a></li>
                    <li><a href="../Rostic's%20Academy.php#tests">Тесты</a></li>
                    <li><a href="../documents.php">Документы</a></li>
                    <li><a href="../career.php">Карьера</a></li>
                                        <li><a href="../employees.php">Пользователи</a></li>
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
        <!-- Герой-баннер -->
        <section class="course-hero">
            <div class="container">
                <h1>Для новичков - основы работы в Ростикс</h1>
                <p>Полное руководство для новых сотрудников с нуля до уверенной работы</p>
            </div>
        </section>

        <!-- Содержимое курса -->
        <section class="course-content container">
            <!-- Раздел 1 -->
            <div class="section">
                <h2>Введение в систему Ростикс</h2>
                <p>Ростикс - это современная система автоматизации ресторанов быстрого питания. Она объединяет кухню, кассу и склад в единое рабочее пространство.</p>
                
                <img src="../images/courses/logorost.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Основные модули системы</h3>
                    <p>Система состоит из нескольких ключевых модулей:</p>
                    <ul>
                        <li>Кассовый модуль - для приема и обработки заказов</li>
                        <li>Кухонный дисплей - для отображения заказов поварам</li>
                        <li>Складской учет - контроль ингредиентов и товаров</li>
                        <li>Аналитика - отчеты и статистика работы</li>
                    </ul>
                </div>
            </div>

            <!-- Раздел 2 -->
            <div class="section">
                <h2>Работа с кассовым модулем</h2>
                <p>Кассовый модуль - это ваша основная рабочая зона. Научимся правильно оформлять заказы.</p>
                
                <img src="../images/courses/kassa.jpg" alt="Кассовый модуль Ростикс" width="100">
                
                <div class="step">
                    <h3>Создание нового заказа</h3>
                    <p>1. Нажмите кнопку "Новый заказ" в верхнем меню</p>
                    <p>2. Выберите категорию продукта (бургеры, напитки и т.д.)</p>
                    <p>3. Добавьте выбранные позиции в заказ, кликая по ним</p>
                    <p>4. При необходимости укажите особые пожелания клиента</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Подвал -->
    <footer>
        <div class="container">
            <div class="footer-links">
                <a href="../about.php">О проекте</a>
                <a href="../contacts.php">Контакты</a>
                <a href="../privacy.php">Политика конфиденциальности</a>
            </div>
            <div class="social">
                <a href="https://vk.com/rostics_official?trackcode=3317ac9acONU_xABdQuVI_QWyeIfxqk4rp_FSpD0sF9xehbvCLw" target="_blank" aria-label="VK">
                    <img src="../images/vk.png" alt="VK">
                </a>
                <a href="https://www.youtube.com/channel/UCPX0Uf4FnchKvGnSj-oeFUA" target="_blank" aria-label="../YouTube">
                    <img src="../images/youtube.png" alt="YouTube">
                </a>
                <a href="https://t.me/rostic_kfc" target="_blank" aria-label="Telegram">
                    <img src="../images/telegram.png" alt="Telegram">
                </a>
            </div>
            <p>© 2025 Rostic's Academy. Все права защищены.</p>
        </div>
    </footer>

    <script src="../script.js"></script>
</body>
</html>