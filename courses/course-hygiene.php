<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROSTIC'S ACADEMY - Гигиена и безопасность</title>
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
                <h1>Для новичков - гигиена и безопасность</h1>
                <p>Освойте ключевые принципы соблюдения санитарных норм и техники безопасности на рабочем месте</p>
            </div>
        </section>

        <!-- Содержимое курса -->
        <section class="course-content main-container">
            <!-- Раздел 1 -->
            <div class="section">
                <h2>Основные санитарные требования</h2>
                <p>В Rostic's мы строго соблюдаем стандарты гигиены для обеспечения безопасности наших гостей и сотрудников.</p>
                
                <img src="../images/courses/gigiena.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Обязательные правила:</h3>
                    <ol>
                        <li>Регулярное мытье рук каждые 30 минут</li>
                        <li>Использование одноразовых перчаток при работе с продуктами</li>
                        <li>Смена рабочей одежды ежедневно</li>
                        <li>Дезинфекция рабочих поверхностей каждый час</li>
                        <li>Обязательный медицинский осмотр при появлении симптомов заболеваний</li>
                    </ol>
                </div>
            </div>

            <!-- Раздел 2 -->
            <div class="section">
                <h2>Техника безопасности</h2>
                <p>Правила работы с оборудованием и в производственных помещениях:</p>
                
                <img src="../images/courses/bezopasnost.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>При работе с оборудованием:</h3>
                    <ul>
                        <li>Не использовать неисправное оборудование</li>
                        <li>Перед включением проверять целостность проводов</li>
                        <li>Использовать защитные приспособления (перчатки, очки)</li>
                        <li>Не оставлять работающее оборудование без присмотра</li>
                    </ul>
                </div>
            </div>

            <!-- Раздел 3 -->
            <div class="section">
                <h2>Экстренные ситуации</h2>
                <p>Алгоритм действий в нештатных ситуациях:</p>
                
                <img src="../images/courses/ekstrsit.png" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Порядок действий:</h3>
                    <ol>
                        <li>Сообщить руководителю смены</li>
                        <li>Обеспечить безопасность гостей и сотрудников</li>
                        <li>При необходимости вызвать экстренные службы (112)</li>
                        <li>Следовать инструкциям по эвакуации</li>
                        <li>Зафиксировать происшествие в журнале</li>
                    </ol>
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