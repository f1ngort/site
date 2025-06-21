<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Карьера в Rostic's | Rostic's Academy</title>
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
        <section class="career-hero fade-in">
            <h1 style="color: #e30613">Постройте карьеру в Rostic's</h1>
            <p class="subtitle" style="color: #e30613">Возможности для роста и развития в крупнейшей сети ресторанов</p>
            <a href="#vacancies" class="btn-primary btn-large" style="color: #e30613">Смотреть вакансии</a>
        </section>
        
        <!-- Карьерные пути -->
        <section class="fade-in">
            <h2>Карьерные пути в Rostic's</h2>
            <p class="section-intro">Мы предлагаем четкие траектории профессионального развития для каждой должности</p>
            
            <div class="career-path">
                <div class="path-card">
                    <h3>Ресторанный менеджмент</h3>
                    <ul class="career-steps">
                        <li>Кассир/Официант</li>
                        <li>Старший смены</li>
                        <li>Менеджер ресторана</li>
                        <li>Управляющий сетью</li>
                    </ul>
                    <a href="#" class="btn-outline">Подробнее</a>
                </div>
                
                <div class="path-card">
                    <h3>Кухня</h3>
                    <ul class="career-steps">
                        <li>Помощник повара</li>
                        <li>Повар</li>
                        <li>Шеф-повар</li>
                        <li>Региональный шеф-повар</li>
                    </ul>
                    <a href="#" class="btn-outline">Подробнее</a>
                </div>
                
                <div class="path-card">
                    <h3>Корпоративный офис</h3>
                    <ul class="career-steps">
                        <li>Специалист</li>
                        <li>Менеджер направления</li>
                        <li>Руководитель департамента</li>
                        <li>Топ-менеджер</li>
                    </ul>
                    <a href="#" class="btn-outline">Подробнее</a>
                </div>
            </div>
        </section>
        
        <!-- Преимущества работы -->
        <section class="fade-in">
            <h2>Почему выбирают Rostic's?</h2>
            <p class="section-intro">Мы создаем условия для профессионального и личностного роста</p>
            
            <div class="benefits-grid">
                <div class="benefit-card">
                    <img src="images/rost.png" width="50">
                    <h3>Карьерный рост</h3>
                    <p>80% управляющих начинали с базовых позиций</p>
                </div>
                
                <div class="benefit-card">
                    <img src="images/obuchenie.png" width="50">
                    <h3>Обучение</h3>
                    <p>Бесплатные курсы и тренинги для развития</p>
                </div>
                
                <div class="benefit-card">
                    <img src="images/dohod.png" width="50">
                    <h3>Доход</h3>
                    <p>Конкурентная зарплата и бонусы</p>
                </div>
                
                <div class="benefit-card">
                    <img src="images/goegrafia.png" width="50">
                    <h3>География</h3>
                    <p>Возможности в 50+ городах России</p>
                </div>
            </div>
        </section>
        
        <!-- Вакансии -->
        <section class="vacancies fade-in" id="vacancies">
            <h2>Актуальные вакансии</h2>
            <p class="section-intro">Присоединяйтесь к нашей команде профессионалов</p>
            <div class="vacancy-list">
                <div class="vacancy-card">
                    <div class="vacancy-header">
                        <h3>Менеджер ресторана</h3>
                        <span class="vacancy-salary">от 80 000 ₽</span>
                    </div>
                    <div class="vacancy-meta">
                        <span class="meta-item">Москва</span>
                        <span class="meta-item">Опыт от 1 года</span>
                    </div>
                    <p class="vacancy-desc">Полный цикл управления рестораном: контроль работы персонала, обеспечение стандартов обслуживания, работа с отчетностью.</p>
                    <div class="vacancy-footer">
                        <a href="#" class="btn-primary">Откликнуться</a>
                        <a href="#" class="btn-outline">Подробнее</a>
                    </div>
                </div>
                
                <div class="vacancy-card">
                    <div class="vacancy-header">
                        <h3>Повар</h3>
                        <span class="vacancy-salary">от 60 000 ₽</span>
                    </div>
                    <div class="vacancy-meta">
                        <span class="meta-item">Санкт-Петербург</span>
                        <span class="meta-item">Опыт не требуется</span>
                    </div>
                    <p class="vacancy-desc">Приготовление блюд по стандартам Rostic's, поддержание чистоты на рабочем месте, контроль качества продукции.</p>
                    <div class="vacancy-footer">
                        <a href="#" class="btn-primary">Откликнуться</a>
                        <a href="#" class="btn-outline">Подробнее</a>
                    </div>
                </div>
                
                <div class="vacancy-card">
                    <div class="vacancy-header">
                        <h3>Кассир</h3>
                        <span class="vacancy-salary">от 45 000 ₽</span>
                    </div>
                    <div class="vacancy-meta">
                        <span class="meta-item">Казань</span>
                        <span class="meta-item">Опыт не требуется</span>
                    </div>
                    <p class="vacancy-desc">Обслуживание гостей на кассе, работа с кассовым аппаратом, поддержание чистоты в зале.</p>
                    <div class="vacancy-footer">
                        <a href="#" class="btn-primary">Откликнуться</a>
                        <a href="#" class="btn-outline">Подробнее</a>
                    </div>
                </div>
                
                <div class="vacancy-card">
                    <div class="vacancy-header">
                        <h3>Маркетолог</h3>
                        <span class="vacancy-salary">от 90 000 ₽</span>
                    </div>
                    <div class="vacancy-meta">
                        <span class="meta-item">Москва</span>
                        <span class="meta-item">Опыт от 2 лет</span>
                    </div>
                    <p class="vacancy-desc">Разработка и реализация маркетинговых активностей для сети ресторанов, анализ эффективности рекламных каналов.</p>
                    <div class="vacancy-footer">
                        <a href="#" class="btn-primary">Откликнуться</a>
                        <a href="#" class="btn-outline">Подробнее</a>
                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <a href="#" class="btn-outline">Показать еще вакансии</a>
            </div>
        </section>
        
        
        <!-- Форма подписки -->
        <section class="subscribe-section fade-in">
            <div class="subscribe-card">
                <h2>Хотите быть в курсе новых вакансий?</h2>
                <p>Подпишитесь на рассылку и получайте первыми информацию об открытых позициях</p>
                
                <form class="subscribe-form">
                    <input type="email" placeholder="Ваш email" required>
                    <button type="submit" class="btn-primary">Подписаться</button>
                </form>
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