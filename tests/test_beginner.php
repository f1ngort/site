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
        <h1>Тестирование по курсу "для новичков"</h1>
        <div class="progress-bar">
            <div class="progress" id="progress"></div>
        </div>
        
        <form id="quiz-form">
            <!-- Вопрос 1 -->
            <div class="question active" id="q1">
                <p>1. Как следует приветствовать гостя?</p>
                <label><input type="radio" name="q1" value="a"> Кивнуть головой</label>
                <label><input type="radio" name="q1" value="b"> Улыбнуться и сказать: "Здравствуйте, добро пожаловать в Rostic's!"</label>
                <label><input type="radio" name="q1" value="c"> Спросить: "Что будете заказывать?"</label>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 2 -->
            <div class="question" id="q2">
                <p>2. Как часто нужно мыть руки?</p>
                <label><input type="radio" name="q2" value="a"> Каждые 30 минут</label>
                <label><input type="radio" name="q2" value="b"> Только перед началом смены</label>
                <label><input type="radio" name="q2" value="c"> Когда руки явно грязные</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 3 -->
            <div class="question" id="q3">
                <p>3. Что делать при возражениях гостя?</p>
                <label><input type="radio" name="q3" value="a"> Спорить с гостем</label>
                <label><input type="radio" name="q3" value="b"> Выслушать, извиниться, предложить решение</label>
                <label><input type="radio" name="q3" value="c"> Позвать менеджера</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 4 -->
            <div class="question" id="q4">
                <p>4. Как правильно оформить заказ?</p>
                <label><input type="radio" name="q4" value="a"> Запомнить и передать на кухню</label>
                <label><input type="radio" name="q4" value="b"> Внести в систему, повторить гостю для подтверждения</label>
                <label><input type="radio" name="q4" value="c"> Дать гостю заполнить бланк</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 5 -->
            <div class="question" id="q5">
                <p>5. Какой стандарт внешнего вида?</p>
                <label><input type="radio" name="q5" value="a"> Чистая форма, аккуратная прическа</label>
                <label><input type="radio" name="q5" value="b"> Любая удобная одежда</label>
                <label><input type="radio" name="q5" value="c"> Джинсы и футболка</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 6 -->
            <div class="question" id="q6">
                <p>6. Что делать при порезах?</p>
                <label><input type="radio" name="q6" value="a"> Продолжить работу</label>
                <label><input type="radio" name="q6" value="b"> Остановить кровь, продезинфицировать, наложить повязку</label>
                <label><input type="radio" name="q6" value="c"> Сообщить коллеге</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 7 -->
            <div class="question" id="q7">
                <p>7. Как часто дезинфицировать поверхности?</p>
                <label><input type="radio" name="q7" value="a"> Каждый час</label>
                <label><input type="radio" name="q7" value="b"> Раз в день</label>
                <label><input type="radio" name="q7" value="c"> Когда заметно загрязнение</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 8 -->
            <div class="question" id="q8">
                <p>8. Как хранить продукты?</p>
                <label><input type="radio" name="q8" value="a"> В любом свободном месте</label>
                <label><input type="radio" name="q8" value="b"> Согласно маркировке и температурному режиму</label>
                <label><input type="radio" name="q8" value="c"> На полу в подсобке</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 9 -->
            <div class="question" id="q9">
                <p>9. Что делать при ожогах?</p>
                <label><input type="radio" name="q9" value="a"> Охладить под проточной водой 10-15 минут</label>
                <label><input type="radio" name="q9" value="b"> Намазать маслом</label>
                <label><input type="radio" name="q9" value="c"> Продолжить работу</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 10 -->
            <div class="question" id="q10">
                <p>10. Когда менять перчатки?</p>
                <label><input type="radio" name="q10" value="a"> После каждого контакта с грязными поверхностями</label>
                <label><input type="radio" name="q10" value="b"> Раз в день</label>
                <label><input type="radio" name="q10" value="c"> Когда порвутся</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 11 -->
            <div class="question" id="q11">
                <p>11. Что делать перед включением оборудования?</p>
                <label><input type="radio" name="q11" value="a"> Проверить целостность проводов</label>
                <label><input type="radio" name="q11" value="b"> Сразу начать использовать</label>
                <label><input type="radio" name="q11" value="c"> Попросить коллегу включить</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 12 -->
            <div class="question" id="q12">
                <p>12. Как переносить нож?</p>
                <label><input type="radio" name="q12" value="a"> Острием вперед</label>
                <label><input type="radio" name="q12" value="b"> Острием вниз, прижатым к бедру</label>
                <label><input type="radio" name="q12" value="c"> Бросить коллеге</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 13 -->
            <div class="question" id="q13">
                <p>13. Что делать при неисправности оборудования?</p>
                <label><input type="radio" name="q13" value="a"> Продолжить использование</label>
                <label><input type="radio" name="q13" value="b"> Немедленно сообщить руководителю</label>
                <label><input type="radio" name="q13" value="c"> Попытаться починить самому</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 14 -->
            <div class="question" id="q14">
                <p>14. Как хранить ножи?</p>
                <label><input type="radio" name="q14" value="a"> В ящике стола</label>
                <label><input type="radio" name="q14" value="b"> В специальных подставках или магнитных держателях</label>
                <label><input type="radio" name="q14" value="c"> На разделочной доске</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 15 -->
            <div class="question" id="q15">
                <p>15. Можно ли оставлять работающее оборудование без присмотра?</p>
                <label><input type="radio" name="q15" value="a"> Да, если ненадолго</label>
                <label><input type="radio" name="q15" value="b"> Нет, никогда</label>
                <label><input type="radio" name="q15" value="c"> Только фритюрницу</label>
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

    <script src="test_script_beginner.js"></script>
</body>
</html>