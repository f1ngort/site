<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROSTIC'S ACADEMY - Увеличение продаж</title>
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
                <h1>Для менеджеров - Увеличение продаж</h1>
                <p>Освойте проверенные техники роста среднего чека и повышения лояльности гостей</p>
            </div>
        </section>

        <!-- Содержимое курса -->
        <section class="course-content main-container">
            <!-- Раздел 1 -->
            <div class="section">
                <h2>Анализ продаж и KPI</h2>
                <p>Ключевые метрики для оценки эффективности ресторана.</p>
                
                <img src="../images/courses/analiz.png" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Основные показатели:</h3>
                    <ol>
                        <li>Средний чек - суммарная выручка / количество чеков</li>
                        <li>Конверсия - соотношение посетителей и покупателей</li>
                        <li>Retention rate - процент возвращающихся гостей</li>
                        <li>Продажи на м² - эффективность использования площади</li>
                        <li>ROI - возврат инвестиций в маркетинг</li>
                    </ol>
                </div>
            </div>

            <!-- Раздел 2 -->
            <div class="section">
                <h2>Техники апселлинга</h2>
                <p>Как увеличить средний чек без навязчивости.</p>
                
                <img src="../images/courses/upselling.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Эффективные методы:</h3>
                    <ul>
                        <li>Предложение премиальных ингредиентов</li>
                        <li>Комбо-предложения с выгодной ценой</li>
                        <li>Ограниченные по времени спецпредложения</li>
                        <li>Персонализированные рекомендации</li>
                        <li>Продажа сопутствующих товаров (соусы, напитки)</li>
                    </ul>
                </div>
            </div>

            <!-- Раздел 3 -->
            <div class="section">
                <h2>Программы лояльности</h2>
                <p>Как превратить разовых гостей в постоянных клиентов.</p>
                
                <img src="../images/courses/loyal.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Работающие инструменты:</h3>
                    <ol>
                        <li>Бонусы для пользователей приложения</li>
                        <li>Персональные скидки для постоянных гостей</li>
                        <li>Эксклюзивные предложения по email/SMS</li>
                        <li>Сезонные акции и тематические мероприятия</li>
                    </ol>
                </div>
            </div>

            <!-- Раздел 4 -->
            <div class="section">
                <h2>Управление командой для роста продаж</h2>
                <p>Как мотивировать персонал на достижение планов.</p>
                
                <img src="../images/courses/upravlenie.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Система мотивации:</h3>
                    <ul>
                        <li>Четкие планы продаж с разбивкой по сменам</li>
                        <li>Грейдированный процент от продаж</li>
                        <li>Соревнования между сменами/ресторанами</li>
                        <li>Ежедневный разбор лучших практик</li>
                        <li>Тренинги по продуктам и техникам продаж</li>
                        <li>Акция "Приведи друга"</li>
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