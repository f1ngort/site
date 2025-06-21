<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROSTIC'S ACADEMY - Работа с отчётами</title>
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
                <h1>Для менеджеров - Работа с отчётами</h1>
                <p>Освойте профессиональные инструменты анализа и интерпретации данных для эффективного управления рестораном</p>
            </div>
        </section>

        <!-- Содержимое курса -->
        <section class="course-content main-container">
            <!-- Раздел 1 -->
            <div class="section">
                <h2>Основные типы отчётов</h2>
                <p>Ключевые документы для ежедневного анализа работы ресторана.</p>
                
                 <img src="../images/courses/otchet.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Обязательные отчёты:</h3>
                    <ol>
                        <li>Сменный отчёт (Z-отчёт) - основные финансовые показатели</li>
                        <li>Отчёт по товарным остаткам - контроль запасов</li>
                        <li>Анализ продаж по категориям - динамика спроса</li>
                        <li>Тайм-карта сотрудников - учёт рабочего времени</li>
                        <li>Отчёт по инкассации - движение наличных средств</li>
                    </ol>
                </div>
            </div>

            <!-- Раздел 2 -->
            <div class="section">
                <h2>Анализ финансовых показателей</h2>
                <p>Как читать и интерпретировать ключевые метрики.</p>
                
                 <img src="../images/courses/finanaliz.png" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Главные показатели:</h3>
                    <ul>
                        <li>Выручка: фактическая vs план</li>
                        <li>Средний чек: динамика изменения</li>
                        <li>Food cost: себестоимость продуктов</li>
                        <li>Labor cost: доля расходов на персонал</li>
                        <li>Маржинальность: чистая прибыль по категориям</li>
                    </ul>
                </div>
            </div>

            <!-- Раздел 3 -->
            <div class="section">
                <h2>Работа в Rostic's Analytics</h2>
                <p>Использование корпоративной системы отчётности.</p>
                
                 <img src="../images/courses/analitika.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Основные функции:</h3>
                    <ol>
                        <li>Формирование стандартных отчётов</li>
                        <li>Настройка персональных дашбордов</li>
                        <li>Экспорт данных в Excel/PDF</li>
                        <li>Сравнение показателей между ресторанами</li>
                        <li>Автоматические алерты при отклонениях</li>
                    </ol>
                </div>
            </div>

            <!-- Раздел 4 -->
            <div class="section">
                <h2>Принятие решений на основе данных</h2>
                <p>Как превращать цифры в управленческие действия.</p>
                
                 <img src="../images/courses/prinresh.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Практические кейсы:</h3>
                    <ul>
                        <li>Корректировка ассортимента на основе продаж</li>
                        <li>Оптимизация графика работы персонала</li>
                        <li>Выявление сезонных трендов и подготовка к ним</li>
                        <li>Расчёт эффективности маркетинговых акций</li>
                        <li>Выявление проблемных зон ресторана</li>
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