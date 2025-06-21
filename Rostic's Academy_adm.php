<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rostic's Academy | Обучение сотрудников</title>
    <link rel="icon" href="images/icon.png" type="image/png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Шапка сайта -->
    <header class="fade-in">
        <div class="container">
            <div class="logo">
                <img src="images/logo.png" alt="Rostic's Academy">
            </div>
            <link rel="icon" href="images/icon.png" type="image/png">
            <nav>
                <ul>
                    <li><a href="#courses">Курсы</a></li>
                    <li><a href="#tests">Тесты</a></li>
                    <li><a href="documents.php">Документы</a></li>
                    <li><a href="career.php">Карьера</a></li>
                    <li><a href="employees.php">Сотрудники</a></li>
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

    <!-- Основной контент -->
    <main>
        <!-- Герой-баннер -->
        <section class="hero fade-in">
            <div class="container">
                <h1>Добро пожаловать в Rostic's Academy!</h1>
                <p>Повышайте квалификацию, осваивайте новые навыки и растите вместе с нами.</p>
                <a href="#courses" class="cta-button">Начать обучение</a>
            </div>
        </section>

        <!-- Блок с курсами -->
        <section id="courses">
            <div class="container">
                <h2 class="fade-in">Наши курсы</h2>
                <div class="course-categories">
                    <div class="category fade-in">
                        <h3>Для новичков</h3>
                        <ul>
                            <li><a href="courses/course-basics.php">Основы работы в Rostic's</a></li>
                            <li><a href="courses/course-standarts.php">Стандарты обслуживания</a></li>
                            <li><a href="courses/course-hygiene.php">Гигиена и безопасность</a></li>
                        </ul>
                    </div>
                    <div class="category fade-in" style="transition-delay: 0.2s">
                        <h3>Для поваров</h3>
                        <ul>
                            <li><a href="courses/course-cooking.php">Идеальное приготовление</a></li>
                            <li><a href="courses/course-safety.php">Безопасность на кухне</a></li>
                            <li><a href="courses/course-speed.php">Оперативность</a></li>
                        </ul>
                    </div>
                    <div class="category fade-in" style="transition-delay: 0.4s">
                        <h3>Для менеджеров</h3>
                        <ul>
                            <li><a href="courses/course-management.php">Управление командой</a></li>
                            <li><a href="courses/course-sales.php">Увеличение продаж</a></li>
                            <li><a href="courses/course-reports.php">Работа с отчётами</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
         <section id="tests">
            <div class="container">
                <h2 class="fade-in">Тесты для проверки пройденных курсов</h2>
                <div class="course-categories">
                    <div class="category fade-in">
                        <ul>
                            <li><a href="tests/test_beginner.php">Для новичков</a></li>
                            <li><a href="tests/test_cook.php">Для поворов</a></li>
                            <li><a href="tests/test_manager.php">Для менеджеров</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Блок "Как это работает" -->
        <section class="how-it-works fade-in">
            <div class="container">
                <h2>Как проходит обучение?</h2>
                <ol>
                    <li>Выбираете курс</li>
                    <li>Изучаете материалы</li>
                    <li>Проходите тест</li>
                </ol>
            </div>
        </section>

        <!-- Мотивационный блок -->
        <section class="motivation fade-in">
            <div class="container">
                <h2>Ваш рост — наш приоритет</h2>
                <p>Лучшие сотрудники получают бонусы и возможность карьерного роста!</p>
            </div>
        </section>
    </main>

    <!-- Подвал -->
    <footer class="fade-in">
        <div class="container">
            <div class="footer-links">
                <a href="about.php">О проекте</a>
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