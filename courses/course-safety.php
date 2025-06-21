<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROSTIC'S ACADEMY - Безопасность на кухне</title>
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
                <h1>Для поваров - Безопасность на кухне</h1>
                <p>Освойте ключевые принципы безопасной работы в производственных помещениях Rostic's</p>
            </div>
        </section>

        <!-- Содержимое курса -->
        <section class="course-content main-container">
            <!-- Раздел 1 -->
            <div class="section">
                <h2>Работа с оборудованием</h2>
                <p>Правила безопасной эксплуатации кухонного оборудования.</p>
                
                <img src="../images/courses/plita.png" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Основные правила:</h3>
                    <ol>
                        <li>Перед использованием проверяйте исправность оборудования</li>
                        <li>Не оставляйте работающее оборудование без присмотра</li>
                        <li>Используйте защитные приспособления (перчатки, очки)</li>
                        <li>Отключайте от сети при очистке и обслуживании</li>
                        <li>Немедленно сообщайте о неисправностях</li>
                    </ol>
                </div>
            </div>

            <!-- Раздел 2 -->
            <div class="section">
                <h2>РАБОТА С ФРИТЮРОМ</h2>
                <p>ТЕХНИКА БЕЗОПАСНОСТИ ПРИ РАБОТЕ С ГОРЯЧИМ МАСЛОМ.</p>
                
                <img src="../images/courses/oborud.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Правила работы:</h3>
                    <ul>
                        <li>ИСПОЛЬЗУЙТЕ ТЕРМОСТОЙКИЕ ПЕРЧАТКИ - ГОРЯЧЕЕ МАСЛО ВЫЗЫВАЕТ СИЛЬНЫЕ ОЖОГИ</li>
                        <li>ПОГРУЖАЙТЕ ПРОДУКТЫ АККУРАТНО, ЧТОБЫ ИЗБЕЖАТЬ БРЫЗГ</li>
                        <li>СЛЕДИТЕ ЗА ТЕМПЕРАТУРОЙ МАСЛА (РЕКОМЕНДУЕМЫЙ ДИАПАЗОН 175-190°C)</li>
                        <li>НЕ ОСТАВЛЯЙТЕ ФРИТЮРНИЦУ БЕЗ ПРИСМОТРА</li>
                        <li>ИСПОЛЬЗУЙТЕ ШУМОВКУ ДЛЯ БЕЗОПАСНОГО ИЗВЛЕЧЕНИЯ ПРОДУКТОВ</li>
                    </ul>
                </div>
            </div>

            <!-- Раздел 3 -->
            <div class="section">
                <h2>Экстренные ситуации</h2>
                <p>Действия при возникновении нештатных ситуаций на кухне.</p>
                
                <img src="../images/courses/ekstrsit.png" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Алгоритм действий:</h3>
                    <ol>
                        <li>При возгорании: отключите оборудование, накройте очаг и/или используйте огнетушитель</li>
                        <li>При порезах: остановите кровь, продезинфицируйте, наложите повязку</li>
                        <li>При ожогах: охладите под проточной водой 10-15 минут</li>
                        <li>При попадании химикатов в глаза: промойте под проточной водой</li>
                        <li>Немедленно сообщите руководителю смены</li>
                    </ol>
                </div>
            </div>

            <!-- Раздел 4 -->
            <div class="section">
                <h2>Гигиена рабочего места</h2>
                <p>Поддержание чистоты для предотвращения травм.</p>
                
                 <img src="../images/courses/uborkakuhni.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Обязательные требования:</h3>
                    <ul>
                        <li>Немедленно убирайте пролитые жидкости</li>
                        <li>Храните инвентарь на предназначенных местах</li>
                        <li>Используйте нескользящую обувь</li>
                        <li>Следите за чистотой полов и рабочих поверхностей</li>
                        <li>Регулярно мойте руки и используйте перчатки</li>
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