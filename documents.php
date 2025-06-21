<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Документы | Rostic's Academy</title>
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
        <section class="documents-hero fade-in">
            <h1>Документы Rostic's Academy</h1>
            <p class="subtitle">Материалы и регламентирующие документы для сотрудников</p>
        </section>
        
        <!-- Категории документов -->
        <section class="fade-in">
            <h2>Категории документов</h2>
            <p class="section-intro">Все необходимые материалы для обучения и работы в сети Rostic's</p>
            
            <div class="documents-categories">
                <div class="category-card">
                    <img src="images/svitok.png" alt="Rostic's Academy" width="50">
                    <h3>Нормативные документы</h3>
                    <p>Стандарты компании, политики и регламенты</p>
                    <a href="#regulatory" class="btn-outline">Просмотреть</a>
                </div>
                
                <div class="category-card">
                    <img src="images/knigi.png" alt="Rostic's Academy" width="50">
                    <h3>Учебные материалы</h3>
                    <p>Пособия, инструкции и методические рекомендации</p>
                    <a href="#educational" class="btn-outline">Просмотреть</a>
                </div>
                
                <div class="category-card">
                    <img src="images/listikor.png" alt="Rostic's Academy" width="50">
                    <h3>Формы и шаблоны</h3>
                    <p>Бланки для отчетности и рабочих процессов</p>
                    <a href="#templates" class="btn-outline">Просмотреть</a>
                </div>
                
                <div class="category-card">
                    <img src="images/zamok.png" alt="Rostic's Academy" width="50">
                    <h3>Внутренние документы</h3>
                    <p>Материалы для руководителей и HR</p>
                    <a href="#internal" class="btn-outline">Просмотреть</a>
                </div>
            </div>
        </section>
        
        <!-- Нормативные документы -->
        <section class="documents-section fade-in" id="regulatory">
            <h2>Нормативные документы</h2>
            <p class="section-intro">Основные стандарты и политики компании</p>
            
            <div class="documents-list">
                <div class="document-card">
                    <img src="images/list.png" alt="Rostic's Academy" width="30">
                    <div class="document-info">
                        <h3>Стандарты обслуживания</h3>
                        <p class="document-meta">PDF, 2.4 MB · Обновлен 15.03.2024</p>
                        <p>Основные принципы работы с гостями в ресторанах Rostic's</p>
                    </div>
                    <a href="#" class="btn-outline">Скачать</a>
                </div>
                
                <div class="document-card">
                    <img src="images/list.png" alt="Rostic's Academy" width="30">
                    <div class="document-info">
                        <h3>Политика безопасности пищевых продуктов</h3>
                        <p class="document-meta">PDF, 1.8 MB · Обновлен 01.02.2024</p>
                        <p>Требования к хранению и приготовлению продукции</p>
                    </div>
                    <a href="#" class="btn-outline">Скачать</a>
                </div>
                
                <div class="document-card">
                    <img src="images/list.png" alt="Rostic's Academy" width="30">
                    <div class="document-info">
                        <h3>Корпоративный кодекс</h3>
                        <p class="document-meta">PDF, 3.1 MB · Обновлен 10.01.2024</p>
                        <p>Правила поведения и ценности компании</p>
                    </div>
                    <a href="#" class="btn-outline">Скачать</a>
                </div>
            </div>
        </section>
        
        <!-- Учебные материалы -->
        <section class="documents-section fade-in" id="educational">
            <h2>Учебные материалы</h2>
            <p class="section-intro">Пособия и инструкции для обучения сотрудников</p>
            <div class="documents-list">
                <div class="document-card">
                    <img src="images/knigi.png" alt="Rostic's Academy" width="30">
                    <div class="document-info">
                        <h3>Руководство для кассира</h3>
                        <p class="document-meta">PDF, 4.2 MB · Версия 3.0</p>
                        <p>Полное руководство по работе на кассе и обслуживанию гостей</p>
                    </div>
                    <a href="#" class="btn-outline">Скачать</a>
                </div>
                
                <div class="document-card">
                  <img src="images/knigi.png" alt="Rostic's Academy" width="30">
                    <div class="document-info">
                        <h3>Технологические карты блюд</h3>
                        <p class="document-meta">PDF, 5.7 MB · Обновлен 20.02.2024</p>
                        <p>Стандарты приготовления всех блюд меню Rostic's</p>
                    </div>
                    <a href="#" class="btn-outline">Скачать</a>
                </div>
                
                <div class="document-card">
                   <img src="images/knigi.png" alt="Rostic's Academy" width="30">
                    <div class="document-info">
                        <h3>Обучение менеджеров</h3>
                        <p class="document-meta">ZIP, 12.4 MB · Полный курс</p>
                        <p>Материалы для обучения управляющих ресторанами</p>
                    </div>
                    <a href="#" class="btn-outline">Скачать</a>
                </div>
                
                <div class="document-card">
                   <img src="images/knigi.png" alt="Rostic's Academy" width="30">
                    <div class="document-info">
                        <h3>Чек-листы открытия/закрытия</h3>
                        <p class="document-meta">PDF, 1.1 MB · Версия 2.1</p>
                        <p>Пошаговые инструкции для открытия и закрытия ресторана</p>
                    </div>
                    <a href="#" class="btn-outline">Скачать</a>
                </div>
            </div>
        </section>
        
        <!-- Формы и шаблоны -->
        <section class="documents-section fade-in" id="templates">
            <h2>Формы и шаблоны</h2>
            <p class="section-intro">Готовые бланки для ежедневной работы</p>
            
            <div class="documents-list">
                <div class="document-card">
                    <img src="images/listikor.png" alt="Rostic's Academy" width="30">
                    <div class="document-info">
                        <h3>Форма инвентаризации</h3>
                        <p class="document-meta">Excel, 350 KB · Версия 1.2</p>
                        <p>Шаблон для проведения инвентаризации в ресторане</p>
                    </div>
                    <a href="#" class="btn-outline">Скачать</a>
                </div>
                
                <div class="document-card">
                    <img src="images/listikor.png" alt="Rostic's Academy" width="30">
                    <div class="document-info">
                        <h3>Журнал учета температур</h3>
                        <p class="document-meta">Word, 280 KB · Версия 1.0</p>
                        <p>Шаблон для ежедневного контроля температурных режимов</p>
                    </div>
                    <a href="#" class="btn-outline">Скачать</a>
                </div>
                
                <div class="document-card">
                    <img src="images/listikor.png" alt="Rostic's Academy" width="30">
                    <div class="document-info">
                        <h3>Форма заявки на ремонт</h3>
                        <p class="document-meta">PDF, 450 KB · Версия 2.0</p>
                        <p>Бланк для оформления заявок на техническое обслуживание</p>
                    </div>
                    <a href="#" class="btn-outline">Скачать</a>
                </div>
            </div>
        </section>
        
        <!-- Внутренние документы -->
        <section class="documents-section fade-in" id="internal">
            <h2>Внутренние документы</h2>
            <p class="section-intro">Материалы для руководителей и HR-специалистов</p>
            <div class="access-notice">
                <p>⚠️ Для доступа к этим документам требуется авторизация с правами руководителя</p>
            </div>
            
            <div class="documents-list">
                <div class="document-card">
                    <img src="images/zamok.png" alt="Rostic's Academy" width="30">
                    <div class="document-info">
                        <h3>HR-политики</h3>
                        <p class="document-meta">PDF, 2.1 MB · Конфиденциально</p>
                        <p>Кадровая политика, правила найма и адаптации</p>
                    </div>
                    <a href="#" class="btn-outline">Запросить доступ</a>
                </div>
                
                <div class="document-card">
                    <img src="images/zamok.png" alt="Rostic's Academy" width="30">
                    <div class="document-info">
                        <h3>Финансовая отчетность</h3>
                        <p class="document-meta">Excel, 1.5 MB · Конфиденциально</p>
                        <p>Шаблоны для финансового планирования и анализа</p>
                    </div>
                    <a href="#" class="btn-outline">Запросить доступ</a>
                </div>
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