<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROSTIC'S ACADEMY - Оперативность на кухне</title>
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
                <h1>Для поваров - Оперативность</h1>
                <p>Освойте техники скоростного приготовления без потери качества</p>
            </div>
        </section>

        <!-- Содержимое курса -->
        <section class="course-content main-container">
            <!-- Раздел 1 -->
            <div class="section">
                <h2>Принципы организации рабочего места</h2>
                <p>Правильная организация пространства - основа оперативной работы.</p>
                
                <img src="../images/courses/rabmesto.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Зоны эффективности:</h3>
                    <ol>
                        <li>Зона подготовки - все ингредиенты нарезаны и разложены</li>
                        <li>Зона тепловой обработки - легкий доступ к плитам и фритюрницам</li>
                        <li>Зона сборки - логичная последовательность компонентов</li>
                        <li>Зона выдачи - проверка качества перед подачей</li>
                    </ol>
                </div>
            </div>

            <!-- Раздел 2 -->
            <div class="section">
                <h2>Техники скоростного приготовления</h2>
                <p>Профессиональные методы для ускорения процессов.</p>
                
                <img src="../images/courses/skorost.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Секреты скорости:</h3>
                    <ul>
                        <li>Параллельная обработка ингредиентов</li>
                        <li>Использование таймеров для контроля времени</li>
                        <li>Предварительный разогрев оборудования</li>
                        <li>Система FIFO (первым пришел - первым ушел)</li>
                    </ul>
                </div>
            </div>

            <!-- Раздел 3 -->
            <div class="section">
                <h2>Работа в команде</h2>
                <p>Синхронизация действий для максимальной эффективности.</p>
                
                <img src="../images/courses/komanda.png" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Правила взаимодействия:</h3>
                    <ol>
                        <li>Четкое распределение обязанностей</li>
                        <li>Стандартизированные системы коммуникации</li>
                        <li>Взаимопомощь при пиковой нагрузке</li>
                        <li>Контроль качества на каждом этапе</li>
                        <li>Анализ времени выполнения операций</li>
                    </ol>
                </div>
            </div>

            <!-- Раздел 4 -->
            <div class="section">
                <h2>Инструменты для экономии времени</h2>
                <p>Специальные приспособления для ускорения работы.</p>
                
                <img src="../images/courses/instrumenti.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Must-have оборудование:</h3>
                    <ul>
                        <li>Таймеры с несколькими режимами</li>
                        <li>Термометры мгновенного считывания</li>
                        <li>Порционные мерные емкости</li>
                        <li>Органайзеры для ингредиентов</li>
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