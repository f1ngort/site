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
        <h1>Тестирование по курсу "для менеджеров"</h1>
        <div class="progress-bar">
            <div class="progress" id="progress"></div>
        </div>
        
        <form id="quiz-form">
            <!-- Вопрос 1 -->
            <div class="question active" id="q1">
                <p>1. Какое из этих качеств является ключевым для эффективного менеджера в Rostic's?</p>
                <label><input type="radio" name="q1" value="a"> Микроменеджмент всех процессов</label>
                <label><input type="radio" name="q1" value="b"> Эмоциональный интеллект</label>
                <label><input type="radio" name="q1" value="c"> Жесткий авторитарный стиль</label>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 2 -->
            <div class="question" id="q2">
                <p>2. Какой метод мотивации используется в Rostic's?</p>
                <label><input type="radio" name="q2" value="a"> Штрафы за опоздания</label>
                <label><input type="radio" name="q2" value="b"> Программа "Лучший сотрудник месяца"</label>
                <label><input type="radio" name="q2" value="c"> Снижение зарплаты при невыполнении плана</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 3 -->
            <div class="question" id="q3">
                <p>3. Первый шаг в решении конфликтов по стандарту Rostic's:</p>
                <label><input type="radio" name="q3" value="a"> Немедленное наказание виновных</label>
                <label><input type="radio" name="q3" value="b"> Выявление причины через активное слушание</label>
                <label><input type="radio" name="q3" value="c"> Игнорирование конфликта</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 4 -->
            <div class="question" id="q4">
                <p>4. Оптимальное время для стандартного совещания:</p>
                <label><input type="radio" name="q4" value="a"> 15 минут</label>
                <label><input type="radio" name="q4" value="b"> 30 минут</label>
                <label><input type="radio" name="q4" value="c"> 60 минут</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 5 -->
            <div class="question" id="q5">
                <p>5. Как правильно рассчитать средний чек?</p>
                <label><input type="radio" name="q5" value="a"> Выручка разделить на количество чеков</label>
                <label><input type="radio" name="q5" value="b"> Количество гостей разделить на выручку</label>
                <label><input type="radio" name="q5" value="c"> Сумма продаж разделить на площадь зала</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 6 -->
            <div class="question" id="q6">
                <p>6. Какой метод апселлинга соответствует стандартам Rostic's?</p>
                <label><input type="radio" name="q6" value="a"> Навязчивые предложения</label>
                <label><input type="radio" name="q6" value="b"> Персонализированные рекомендации</label>
                <label><input type="radio" name="q6" value="c"> Принудительное добавление товаров</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 7 -->
            <div class="question" id="q7">
                <p>7. Эффективный инструмент программы лояльности:</p>
                <label><input type="radio" name="q7" value="a"> Разовые случайные скидки</label>
                <label><input type="radio" name="q7" value="b"> Персональные предложения для постоянных гостей</label>
                <label><input type="radio" name="q7" value="c"> Общие купоны без учета предпочтений</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 8 -->
            <div class="question" id="q8">
                <p>8. Что включает система мотивации на продажи?</p>
                <label><input type="radio" name="q8" value="a"> Штрафные санкции</label>
                <label><input type="radio" name="q8" value="b"> Грейдированный процент от продаж</label>
                <label><input type="radio" name="q8" value="c"> Лишение премий</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 9 -->
            <div class="question" id="q9">
                <p>9. Какой отчет показывает движение наличных средств?</p>
                <label><input type="radio" name="q9" value="a"> Товарный отчет</label>
                <label><input type="radio" name="q9" value="b"> Отчет по инкассации</label>
                <label><input type="radio" name="q9" value="c"> График работы персонала</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 10 -->
            <div class="question" id="q10">
                <p>10. Показатель Food cost отражает:</p>
                <label><input type="radio" name="q10" value="a"> Затраты на маркетинг</label>
                <label><input type="radio" name="q10" value="b"> Себестоимость продуктов</label>
                <label><input type="radio" name="q10" value="c"> Расходы на аренду</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 11 -->
            <div class="question" id="q11">
                <p>11. Какая функция доступна в Rostic's Analytics?</p>
                <label><input type="radio" name="q11" value="a"> Настройка персональных дашбордов</label>
                <label><input type="radio" name="q11" value="b"> Просмотр личных сообщений сотрудников</label>
                <label><input type="radio" name="q11" value="c"> Изменение цен в реальном времени</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 12 -->
            <div class="question" id="q12">
                <p>12. Какой показатель лучше оценивает маркетинг?</p>
                <label><input type="radio" name="q12" value="a"> Количество униформ</label>
                <label><input type="radio" name="q12" value="b"> ROI (возврат инвестиций)</label>
                <label><input type="radio" name="q12" value="c"> Площадь кухни</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 13 -->
            <div class="question" id="q13">
                <p>13. Важнейший элемент эффективного совещания:</p>
                <label><input type="radio" name="q13" value="a"> Свободные обсуждения без регламента</label>
                <label><input type="radio" name="q13" value="b"> Четкая повестка дня</label>
                <label><input type="radio" name="q13" value="c"> Максимальное количество участников</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 14 -->
            <div class="question" id="q14">
                <p>14. Правильный подход к решению конфликтов:</p>
                <label><input type="radio" name="q14" value="a"> Мозговой штурм вариантов</label>
                <label><input type="radio" name="q14" value="b"> Автоматическое увольнение спорщиков</label>
                <label><input type="radio" name="q14" value="c"> Запрет на высказывание мнений</label>
                <button type="button" class="prev-btn">Назад</button>
                <button type="button" class="next-btn">Далее</button>
            </div>

            <!-- Вопрос 15 -->
            <div class="question" id="q15">
                <p>15. Какой показатель НЕ является финансовым?</p>
                <label><input type="radio" name="q15" value="a"> Средний чек</label>
                <label><input type="radio" name="q15" value="b"> Маржинальность</label>
                <label><input type="radio" name="q15" value="c"> Цвет посуды</label>
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

    <script src="test_script_manager.js"></script>
</body>
</html>