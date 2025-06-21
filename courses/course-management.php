<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROSTIC'S ACADEMY - Управление командой</title>
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
                <h1>Для менеджеров - Управление командой</h1>
                <p>Освойте современные техники эффективного руководства в ресторанном бизнесе</p>
            </div>
        </section>

        <!-- Содержимое курса -->
        <section class="course-content main-container">
            <!-- Раздел 1 -->
            <div class="section">
                <h2>Основы лидерства</h2>
                <p>Ключевые принципы успешного управления командой в Rostic's.</p>
                
                <img src="../images/courses/lider.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>5 качеств эффективного менеджера:</h3>
                    <ol>
                        <li>Четкая коммуникация - ясная передача информации</li>
                        <li>Эмоциональный интеллект - понимание потребностей команды</li>
                        <li>Делегирование - правильное распределение задач</li>
                        <li>Принятие решений - быстрота и обоснованность</li>
                        <li>Обратная связь - конструктивная оценка работы</li>
                    </ol>
                </div>
            </div>

            <!-- Раздел 2 -->
            <div class="section">
                <h2>Мотивация персонала</h2>
                <p>Как вдохновлять команду на высокие результаты.</p>
                
                <img src="../images/courses/motivacia.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Методы мотивации:</h3>
                    <ul>
                        <li>Система грейдов и карьерного роста</li>
                        <li>Программа "Лучший сотрудник месяца"</li>
                        <li>Корпоративные тренинги и обучение</li>
                        <li>Гибкий график для лучших сотрудников</li>
                        <li>Публичное признание достижений</li>
                    </ul>
                </div>
            </div>

            <!-- Раздел 3 -->
            <div class="section">
                <h2>Решение конфликтов</h2>
                <p>Профессиональные техники управления конфликтными ситуациями.</p>
                
                <img src="../images/courses/konflict.jpeg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Алгоритм решения конфликтов:</h3>
                    <ol>
                        <li>Выявление причины - активное слушание всех сторон</li>
                        <li>Анализ - отделение фактов от эмоций</li>
                        <li>Поиск решений - мозговой штурм вариантов</li>
                        <li>Принятие решения - справедливое и взвешенное</li>
                        <li>Контроль - проверка выполнения договоренностей</li>
                    </ol>
                </div>
            </div>

            <!-- Раздел 4 -->
            <div class="section">
                <h2>Эффективные совещания</h2>
                <p>Как проводить продуктивные планерки и собрания.</p>
                
                <img src="../images/courses/soveshanie.png" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Правила успешных совещаний:</h3>
                    <ul>
                        <li>Четкая повестка дня - сообщается заранее</li>
                        <li>Лимит времени - не более 30 минут</li>
                        <li>Распределение ролей - ведущий, секретарь</li>
                        <li>Конкретные решения - вместо общих разговоров</li>
                        <li>Фиксация результатов - с назначением ответственных</li>
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