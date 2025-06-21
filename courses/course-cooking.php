<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROSTIC'S ACADEMY - Идеальное приготовление</title>
    <link rel="stylesheet" href="..//style.css">
    <link rel="icon" href="../images/icon.png" type="image/x-icon">
</head>
<body>
    <!-- Шапка -->
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
            <div class="main-container">
                <h1>Для поваров - Идеальное приготовление</h1>
                <p>Освойте профессиональные техники приготовления блюд по стандартам Rostic's</p>
            </div>
        </section>

        <!-- Содержимое курса -->
        <section class="course-content main-container">
            <!-- Раздел 1 -->
            <div class="section">
                <h2>ОСНОВЫ ВРЕМЕННОГО КОНТРОЛЯ</h2>
                <p>ПРАВИЛЬНОЕ ПРИГОТОВЛЕНИЕ НАЧИНАЕТСЯ С ТОЧНОГО КОНТРОЛЯ ВРЕМЕНИ.</p>
                
                <img src="../images/courses/kontrolvremeni.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>КЛЮЧЕВЫЕ ВРЕМЕННЫЕ ИНТЕРВАЛЫ:</h3>
                    <ul>
                        <li>ЗИНГЕРЫ: 8-10 МИНУТ</li>
                        <li>СТРИПСЫ: 6-8 МИНУТ</li>
                        <li>КРЫЛЬЯ: 12-15 МИНУТ</li>
                        <li>НОЖКИ: 18-20 МИНУТ</li>
                    </ul>
                </div>
            </div>

            <!-- Раздел 2 -->
            <div class="section">
                <h2>Техники приготовления</h2>
                <p>Профессиональные методы работы с продуктами:</p>
                
                <img src="../images/courses/gotovka.png" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Основные принципы:</h3>
                    <ol>
                        <li>Подготовка всех ингредиентов перед началом</li>
                        <li>Использование правильных инструментов для каждого продукта</li>
                        <li>Контроль времени приготовления каждого компонента</li>
                        <li>Соблюдение последовательности сборки блюд</li>
                    </ol>
                </div>
            </div>

            <!-- Раздел 3 -->
            <div class="section">
                <h2>Подача и оформление</h2>
                <p>КАК ОБЕСПЕЧИТЬ БЫСТРУЮ И АППЕТИТНУЮ ПОДАЧУ БЛЮД:</p>
                
                <img src="../images/courses/podacha.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Правила сервировки:</h3>
                    <ul>
                        <li>ИСПОЛЬЗОВАНИЕ ОДНОРАЗОВОЙ УПАКОВКИ ИЛИ БУМАЖНЫХ КОРЗИНОК</li>
                        <li>ЯРКИЕ И ПРИВЛЕКАТЕЛЬНЫЕ ЦВЕТА УПАКОВКИ</li>
                        <li>БЫСТРЫЕ И ПРОСТЫЕ ФИНИШНЫЕ ЭЛЕМЕНТЫ (СОУСНЫЕ ПАКЕТЫ, САЛФЕТКИ)</li>
                        <li>УДОБНАЯ КОМПАКТНАЯ ВЫКЛАДКА ДЛЯ ГОСТЕЙ</li>
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <!-- Подвал -->
    <footer>
        <div class="main-container">
            <div class="footer-links">
                <a href="../about.php">О проекте</a>
                <a href="../contacts.php">Контакты</a>
                <a href="../privacy.php">Политика конфиденциальности</a>
            </div>
            <div class="social">
                <a href="https://vk.com/rostics_official" target="_blank" aria-label="VK">
                    <img src="../images/vk.png" alt="VK">
                </a>
                <a href="https://www.youtube.com/channel/UCPX0Uf4FnchKvGnSj-oeFUA" target="_blank" aria-label="YouTube">
                    <img src="../images/youtube.png" alt="YouTube">
                </a>
                <a href="https://t.me/rostic_kfc" target="_blank" aria-label="Telegram">
                    <img src="../images/telegram.png" alt="Telegram">
                </a>
            </div>
            <p>© 2025 Rostic's Academy. Все права защищены.</p>
        </div>
    </footer>

    <script src="..//script.js"></script>
</body>
</html>