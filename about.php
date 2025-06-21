<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О проекте | Rostic's Academy</title>
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
    <main>
        <!-- Герой-секция -->
         <section class="hero-about fade-in">
            <h1 style="color: #e30613">О проекте Rostic's Academy</h1>
            <p class="subtitle" style="color: #e30613">Инновационная платформа для обучения и развития сотрудников</p>
        </section>

        <!-- О проекте -->
        <section class="about-section">
            <div class="container">
                <div class="about-grid fade-in">
                    <div class="about-content">
                        <h2>Наша миссия</h2>
                        <p>Rostic's Academy создана для профессионального роста каждого сотрудника сети ресторанов Rostic's. Мы объединяем лучшие практики обучения в удобном цифровом формате.</p>
                        
                        <h2>История создания</h2>
                        <p>В 2025 году сеть ресторанов Rostic's столкнулась с проблемой: высокий оборот кадров и длительный период адаптации новых сотрудников. Традиционное обучение в офлайн-формате было затратным и не всегда эффективным — разные уровни подготовки тренеров, разрозненные методички и отсутствие единого стандарта усложняли процесс.

Руководство компании приняло решение о цифровизации обучения, чтобы повысить качество подготовки и сохранить корпоративную культуру.</p>
                        
                        <div class="features">
                            <div class="feature-item fade-in">
                                <img src="images/mishen.png" alt="Rostic's Academy" width="20">
                                <h3>Целевой подход</h3>
                                <p>Программы обучения, разработанные специально для каждой должности</p>
                            </div>
                            <div class="feature-item fade-in">
                                <img src="images/telefon.png" alt="Rostic's Academy" width="20">
                                <h3>Доступность</h3>
                                <p>Обучение доступно с любого устройства в любое время</p>
                            </div>
                            <div class="feature-item fade-in">
                                <img src="images/grafik.png" alt="Rostic's Academy" width="20">
                                <h3>Эффективность</h3>
                                <p>Практико-ориентированные курсы с измеримыми результатами</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Команда -->
        <section class="team-section">
            <div class="container">
                <h2 class="fade-in">Наша команда</h2>
                <div class="team-grid">
                    <div class="team-member fade-in">
                        <img width="200px" style="border-radius: 6%; border: 1px solid #e30613" src="images/TV.jpg" alt="Тихонов Владислав">
                        <h3>Тихонов Владислав</h3>
                        <p>Основатель проекта</p>
                        <p>Главный разработчик</p>
                    </div>
                    <div class="team-member fade-in">
                        <img width="200px" style="border-radius: 6%; border: 1px solid #e30613" src="images/VA.jpg" alt="Тихонов Владислав">
                        <h3>Виноградская Анна</h3>
                        <p>Тестировщик</p>
                        <p>Главный редактор</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Подвал -->
    <footer class="fade-in">
        <div class="container">
            <div class="footer-links">
                <a href="contacts.php">Контакты</a>
                <a href="privacy.php">Политика конфиденциальности</a>
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