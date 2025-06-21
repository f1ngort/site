<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Политика конфиденциальности | Rostic's Academy</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/icon.png" type="image/x-icon">
</head>
<body>
    <!-- Шапка с навигацией -->
    <header class="header fade-in">
        <div class="container">
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
                                        <li><a href="employees.php">Пользователи</a></li>
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
    <main class="container">
        <section class="privacy-hero fade-in">
            <h1>Политика конфиденциальности</h1>
        </section>
        
        <div class="privacy-content fade-in">
            <p>Rostic's Academy уважает вашу конфиденциальность и обязуется защищать ваши персональные данные. В этом документе описаны принципы сбора, использования и защиты информации на нашем сайте.</p>
            
            <h2>1. Какие данные мы собираем</h2>
            <p>При использовании нашего сайта и сервисов мы можем собирать следующую информацию:</p>
            <ul>
                <li>Личные данные (ФИО, дата рождения, контактные данные) при регистрации</li>
                <li>Информацию о вашем устройстве и подключении к интернету</li>
                <li>Данные о вашей активности на платформе (пройденные курсы, результаты тестов)</li>
                <li>Файлы cookie и аналогичные технологии отслеживания</li>
            </ul>
            
            <h2>2. Как мы используем ваши данные</h2>
            <p>Собранная информация используется для следующих целей:</p>
            <ul>
                <li>Предоставление доступа к учебным материалам</li>
                <li>Персонализация учебного процесса</li>
                <li>Улучшение качества наших услуг</li>
                <li>Обеспечение безопасности платформы</li>
                <li>Выполнение юридических обязательств</li>
            </ul>
            
            <h2>3. Защита данных</h2>
            <p>Мы применяем различные меры безопасности для защиты вашей личной информации:</p>
            <ul>
                <li>Шифрование передаваемых данных</li>
                <li>Регулярные проверки безопасности</li>
                <li>Ограниченный доступ к персональным данным</li>
                <li>Соблюдение международных стандартов защиты данных</li>
            </ul>
            
            <h2>4. Передача данных третьим лицам</h2>
            <p>Мы не продаем и не передаем ваши персональные данные третьим лицам, за исключением:</p>
            <ul>
                <li>Случаев, предусмотренных законодательством</li>
                <li>Сервисных провайдеров, работающих от нашего имени (с обязательством соблюдения конфиденциальности)</li>
                <li>При вашем явном согласии</li>
            </ul>
            
            <h2>5. Ваши права</h2>
            <p>Вы имеете право:</p>
            <ul>
                <li>Запрашивать доступ к вашим персональным данным</li>
                <li>Требовать исправления неточных данных</li>
                <li>Запрашивать удаление ваших данных</li>
                <li>Ограничивать обработку ваших данных</li>
                <li>Отзывать согласие на обработку данных</li>
            </ul>
            
            <h2>6. Файлы cookie</h2>
            <p>Наш сайт использует файлы cookie для:</p>
            <ul>
                <li>Обеспечения работы основных функций</li>
                <li>Анализа использования сайта</li>
                <li>Персонализации контента</li>
            </ul>
            <p>Вы можете управлять настройками cookie в вашем браузере.</p>
        </div>
    </main>

   <!-- Подвал -->
    <footer class="fade-in">
        <div class="container">
            <div class="footer-links">
                <a href="about.php">О проекте</a>
                <a href="contacts.php">Контакты</a>
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

    <script src="script.js"></script>
</body>
</html>