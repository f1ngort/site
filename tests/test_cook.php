<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROSTIC'S ACADEMY - Тест для новичков</title>
    <link rel="stylesheet" href="..//style.css">
    <link rel="stylesheet" href="test_style.css">
    <link rel="icon" href="../images/icon.png" type="image/x-icon">
</head>
<body>
   <header>
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

    <main class="test-container">
        <h1>Тестирование по курсу "для поворов"</h1>
        <div class="progress-bar">
            <div class="progress" id="progress"></div>
        </div>
        
        <form id="quiz-form">
            <!-- Вопрос 1 -->
            <div class="question active" id="q1">
                <p>1. Какое стандартное время приготовления зингеров во фритюре?</p>
                <label><input type="radio" name="q1" value="a"> 5-7 минут</label>
                <label><input type="radio" name="q1" value="b"> 8-10 минут</label>
                <label><input type="radio" name="q1" value="c"> 12-15 минут</label>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 2 -->
            <div class="question" id="q2">
                <p>2. Сколько времени требуется для приготовления стрипсов до золотистой корочки?</p>
                <label><input type="radio" name="q2" value="a"> 4-5 минут</label>
                <label><input type="radio" name="q2" value="b"> 6-8 минут</label>
                <label><input type="radio" name="q2" value="c"> 9-11 минут</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 3 -->
            <div class="question" id="q3">
                <p>3. Что необходимо сделать перед началом приготовления блюд?</p>
                <label><input type="radio" name="q3" value="a"> Подготовить все ингредиенты и инструменты</label>
                <label><input type="radio" name="q3" value="b"> Включить музыку для настроения</label>
                <label><input type="radio" name="q3" value="c"> Надеть только перчатки</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 4 -->
            <div class="question" id="q4">
                <p>4. Какой упаковочный материал предпочтителен для подачи блюд?</p>
                <label><input type="radio" name="q4" value="a"> Одноразовая упаковка или бумажные корзинки</label>
                <label><input type="radio" name="q4" value="b"> Многоразовая керамическая посуда</label>
                <label><input type="radio" name="q4" value="c"> Алюминиевая фольга</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 5 -->
            <div class="question" id="q5">
                <p>5. Что необходимо сделать перед использованием фритюрницы?</p>
                <label><input type="radio" name="q5" value="a"> Проверить исправность и чистоту оборудования</label>
                <label><input type="radio" name="q5" value="b"> Просто включить в сеть</label>
                <label><input type="radio" name="q5" value="c"> Наполнить маслом до краев</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 6 -->
            <div class="question" id="q6">
                <p>6. Какие перчатки следует использовать при работе с горячим маслом?</p>
                <label><input type="radio" name="q6" value="a"> Термостойкие перчатки</label>
                <label><input type="radio" name="q6" value="b"> Обычные латексные перчатки</label>
                <label><input type="radio" name="q6" value="c"> Перчатки не обязательны</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 7 -->
            <div class="question" id="q7">
                <p>7. Что делать при ожоге горячим маслом?</p>
                <label><input type="radio" name="q7" value="a"> Охладить под проточной водой 10-15 минут</label>
                <label><input type="radio" name="q7" value="b"> Намазать маслом или кремом</label>
                <label><input type="radio" name="q7" value="c"> Продолжить работу</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 8 -->
            <div class="question" id="q8">
                <p>8. Как часто нужно мыть руки во время работы?</p>
                <label><input type="radio" name="q8" value="a"> Каждые 30 минут и после каждого загрязнения</label>
                <label><input type="radio" name="q8" value="b"> Только перед началом смены</label>
                <label><input type="radio" name="q8" value="c"> Когда руки явно грязные</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 9 -->
            <div class="question" id="q9">
                <p>9. Как правильно организовать зону сборки блюд?</p>
                <label><input type="radio" name="q9" value="a"> Логичная последовательность компонентов для быстрой сборки</label>
                <label><input type="radio" name="q9" value="b"> Все ингредиенты в случайном порядке</label>
                <label><input type="radio" name="q9" value="c"> Только основные компоненты под рукой</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 10 -->
            <div class="question" id="q10">
                <p>10. Что наиболее важно при работе в команде на кухне?</p>
                <label><input type="radio" name="q10" value="a"> Четкое распределение обязанностей и коммуникация</label>
                <label><input type="radio" name="q10" value="b"> Каждый работает самостоятельно</label>
                <label><input type="radio" name="q10" value="c"> Главное - скорость, а не координация</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 11 -->
            <div class="question" id="q11">
                <p>11. Какой рекомендуемый температурный диапазон для фритюра?</p>
                <label><input type="radio" name="q11" value="a"> 160-170°C</label>
                <label><input type="radio" name="q11" value="b"> 175-190°C</label>
                <label><input type="radio" name="q11" value="c"> 200-220°C</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 12 -->
            <div class="question" id="q12">
                <p>12. Как следует хранить полуфабрикаты перед приготовлением?</p>
                <label><input type="radio" name="q12" value="a"> В холодильнике при температуре +2...+4°C</label>
                <label><input type="radio" name="q12" value="b"> При комнатной температуре</label>
                <label><input type="radio" name="q12" value="c"> В морозильной камере до момента приготовления</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 13 -->
            <div class="question" id="q13">
                <p>13. Как правильно переносить нож на кухне?</p>
                <label><input type="radio" name="q13" value="a"> Острием вниз, прижатым к бедру</label>
                <label><input type="radio" name="q13" value="b"> Неострием вперед</label>
                <label><input type="radio" name="q13" value="c"> В любом удобном положении</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 14 -->
            <div class="question" id="q14">
                <p>14. Когда следует проверять качество приготовленных блюд?</p>
                <label><input type="radio" name="q14" value="a"> Перед каждой подачей</label>
                <label><input type="radio" name="q14" value="b"> Только в начале смены</label>
                <label><input type="radio" name="q14" value="c"> Когда есть свободное время</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 15 -->
            <div class="question" id="q15">
                <p>15. Как часто нужно проводить уборку рабочего места?</p>
                <label><input type="radio" name="q15" value="a"> Постоянно в процессе работы и после завершения</label>
                <label><input type="radio" name="q15" value="b"> Только в конце смены</label>
                <label><input type="radio" name="q15" value="c"> Когда накапливается много грязи</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" id="submit-btn">Завершить тест</button>
            </div>
        </form>

        <div id="results" style="display:none;">
            <h2>Результаты тестирования</h2>
            <p>Ваш результат: <span id="score">0</span>/15</p>
            <p id="result-message"></p>
            <button id="retry-btn" onClick="window.location.reload();">Пройти тест снова</button>
        </div>
    </main>

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

    <script src="test_script_cook.js"></script>
</body>
</html>