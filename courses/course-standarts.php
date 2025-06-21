<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROSTIC'S ACADEMY - Стандарты обслуживания</title>
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
                <h1>Для новичков - стандарты обслуживания</h1>
                <p>Освойте профессиональные стандарты работы с гостями в ресторанах Rostic's</p>
            </div>
        </section>

        <!-- Содержимое курса -->
        <section class="course-content container">
            <!-- Раздел 1 -->
            <div class="section">
                <h2>Основные принципы обслуживания</h2>
                <p>В Rostic's мы придерживаемся высоких стандартов обслуживания, которые делают посещение наших ресторанов приятным для гостей.</p>
                
                <img src="../images/courses/standart.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>5 ключевых принципов:</h3>
                    <ol>
                        <li>Доброжелательность - улыбка и позитивный настрой</li>
                        <li>Оперативность - быстрое обслуживание без задержек</li>
                        <li>Аккуратность - чистая форма и рабочее место</li>
                        <li>Внимательность - предугадывание потребностей гостя</li>
                        <li>Профессионализм - знание меню и стандартов</li>
                    </ol>
                </div>
            </div>

            <!-- Раздел 2 -->
            <div class="section">
                <h2>Этапы обслуживания гостя</h2>
                <p>Каждое взаимодействие с гостем должно следовать четкому алгоритму:</p>
                
                <img src="../images/courses/etapi.png" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>1. Приветствие</h3>
                    <p>- Установите зрительный контакт<br>
                       - Улыбнитесь<br>
                       - Поприветствуйте гостя фразой: "Здравствуйте, добро пожаловать в Rostic's!"</p>
                </div>
                
                <div class="step">
                    <h3>2. Принятие заказа</h3>
                    <p>- Выслушайте<br>
                        - Если нужно, предложите помощь с выбором<br>
                       - Уточните дополнительные пожелания<br>
                       - Повторите заказ для подтверждения</p>
                </div>
            </div>

            <!-- Раздел 3 -->
            <div class="section">
                <h2>Работа с возражениями</h2>
                <p>Важно правильно реагировать на замечания гостей:</p>
                
                <img src="../images/courses/rabotasgostyami.jpg" alt="Интерфейс системы Ростикс" width="100">
                
                <div class="step">
                    <h3>Алгоритм решения проблем:</h3>
                    <ol>
                        <li>Выслушайте гостя без прерываний</li>
                        <li>Извинитесь за доставленные неудобства</li>
                        <li>Предложите решение (замена, возврат, комплимент)</li>
                        <li>Поблагодарите за обратную связь</li>
                        <li>Сообщите менеджеру о ситуации</li>
                    </ol>
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