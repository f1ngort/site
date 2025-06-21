<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты | Rostic's Academy</title>
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
        <!-- Герой-секция -->
        <section class="contacts-hero fade-in">
            <h1 style="color: #e30613">Свяжитесь с нами</h1>
            <p class="subtitle" style="color: #e30613">Мы всегда рады вашим вопросам и предложениям</p>
        </section>
        
        <!-- Контактная информация и форма -->
        <div class="contact-grid">
            <div class="contact-info fade-in">
                <h2>Контактная информация</h2>
                
                <div class="contact-item">
                    <img src="images/metka.png" alt="Rostic's Academy" width="30">
                    <div>
                        <h3>Адрес</h3>
                        <p>г. Москва, ул. Образцова, д. 19, офис 305</p>
                        <p>Бизнес-центр "Ростикс Плаза"</p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <img src="images/trubka.png" alt="Rostic's Academy" width="30">
                    <div>
                        <h3>Телефоны</h3>
                        <p>Единый номер: <a href="tel:+78001234567">8 (800) 123-45-67</a></p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <img src="images/pismo.png" alt="Rostic's Academy" width="30">
                    <div>
                        <h3>Электронная почта</h3>
                        <p>Общие вопросы: <a href="mailto:info@rostics.academy">info@rostics.academy</a></p>
                        <p>Техподдержка: <a href="mailto:support@rostics.academy">support@rostics.academy</a></p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <img src="images/chasi.png" alt="Rostic's Academy" width="30">
                    <div>
                        <h3>Часы работы</h3>
                        <p>Понедельник - Пятница: 9:00 - 18:00</p>
                        <p>Суббота - Воскресенье: выходной</p>
                    </div>
                </div>
            </div>
            
            <div class="contact-form fade-in">
                <h2>Форма обратной связи</h2>
                <form id="feedbackForm">
                    <div class="form-group">
                        <label for="name">Ваше имя</label>
                        <input type="text" id="name" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input type="tel" id="phone" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Тема обращения</label>
                        <select id="subject" class="form-control" required>
                            <option value="" disabled selected>Выберите тему</option>
                            <option value="technical">Техническая поддержка</option>
                            <option value="feedback">Обратная связь</option>
                            <option value="other">Другое</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Сообщение</label>
                        <textarea id="message" class="form-control" required></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Отправить сообщение</button>
                </form>
            </div>
        </div>
        
        <!-- Карта -->
        <div class="map-container fade-in">
            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A1a2b3c4d5e6f7g8h9i0j&amp;source=constructor" width="100%" height="100%" frameborder="0"></iframe>
        </div>
        
        <!-- Дополнительные контакты -->
        <section class="departments fade-in">
            <h2>Отделы компании</h2>
            <div class="dept-grid">
                <div class="dept-item">
                    <h3>Техническая поддержка</h3>
                    <p>Телефон: <a href="tel:+74959876543">+7 (495) 987-65-43</a></p>
                    <p>Email: <a href="mailto:support@rostics.academy">support@rostics.academy</a></p>
                </div>
                <div class="dept-item">
                    <h3>Отдел кадров</h3>
                    <p>Телефон: <a href="tel:+74951234598">+7 (495) 123-45-98</a></p>
                    <p>Email: <a href="mailto:hr@rostics.academy">hr@rostics.academy</a></p>
                </div>
            </div>
        </section>
    </main>

    <!-- Подвал -->
    <footer class="fade-in">
        <div class="container">
            <div class="footer-links">
                <a href="about.php">О проекте</a>
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