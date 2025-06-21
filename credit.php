<?php
session_start();

// Конфигурация базы данных
define('DB_HOST', 'localhost');
define('DB_NAME', 'cars');
define('DB_USER', 'root');
define('DB_PASS', '');

$errors = [];
$success_messages = [];

// Функция для получения PDO подключения
function getPDOConnection() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $pdo = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_PERSISTENT => true
                ]
            );
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }
    
    return $pdo;
}

// Обработка отправки заявки на консультацию
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_consultation'])) {
    if (!isset($_SESSION['user_id'])) {
        $errors[] = "Для подачи заявки необходимо авторизоваться";
    } else {
        try {
            $pdo = getPDOConnection();
            
            // Подготавливаем данные для вставки
            $data = [
                'ln' => $_SESSION['user_ln'] ?? '',
                'fn' => $_SESSION['user_fn'] ?? '',
                'sn' => $_SESSION['user_sn'] ?? '',
                'zayavk' => 'Консультация по автокредиту',
                'status' => 'Новая',
                'email' => $_SESSION['user_email'] ?? '',
            ];
            
            // Вставляем заявку в базу данных
            $stmt = $pdo->prepare("INSERT INTO zayavka (ln, fn, sn, zayavk, status, email) 
                                   VALUES (:ln, :fn, :sn, :zayavk, :status, :email)");
            $stmt->execute($data);
            
            // Сохраняем сообщение в сессии и делаем редирект
            $_SESSION['success_message'] = "Заявка на консультацию по автокредиту успешно отправлена!";
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
            
        } catch(PDOException $e) {
            $errors[] = "Ошибка при отправке заявки: " . $e->getMessage();
        }
    }
}

// Показываем сообщение из сессии (если есть)
if (isset($_SESSION['success_message'])) {
    $success_messages[] = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Удаляем сообщение после показа
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Автоцетр Колесо - Авто кредит</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/modern-normalize/3.0.1/modern-normalize.css">
    <link rel="stylesheet" href="./css/2.css?v=>?= time() ?>">
    <link rel="stylesheet" href="./css/1.css?v=>?= time() ?>">
    <link rel="stylesheet" href="styles.css?v=<?= time() ?>">
    <style>
        .credit-calculator {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin: 20px 0;
            
        }
        .credit-calculator h3 {
            margin-top: 0;
            color: #333;
            text-align:center;
        }
        .calculator-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 36px;
        }
        .calculator-item {
            margin-bottom: 15px;
            position: relative;
        }
        .calculator-item.full-width {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 48px;
        }
        .calculator-item label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        .calculator-item input, .calculator-item select {
            width: 60%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .calculator-results {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
        }
        .result-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .result-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .result-label {
            font-weight: bold;
            color: #CA2A39;
        }
        .result-value {
            color: #CA2A39;
            font-weight: bold;
        }
        button.calculate-btn {
            
            background: #CA2A39;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
            width: 60%;
            
        }
        button.calculate-btn:hover {
            background: #1d4b75;
        }
        .range-value {
            display: inline-block;
            margin-left: 10px;
            font-weight: bold;
            color: #CA2A39;
        }
    </style>
</head>
<body>
    <!-- Уведомление -->
<div id="notification" class="notification"></div>

<!-- Скрытая форма для отправки заявки -->
<form id="consultationForm" class="hidden-form" method="POST">
    <input type="hidden" name="submit_consultation" value="1">
</form>
    <header>
        <div class="header-flex">
            <a href="/base.php" class="logo"></a>
            <nav>
            </nav>
        </div>
    </header>
    <main>
        <section class="Hero credit">
            <h3 class="arbuz">Персональное предложение по кредиту</h3>
            <button type="button" class="button mmm" onclick="submitConsultation()">Получить консультацию</button>
        </section>
        <section class="something">
            <div class="smtbox111"></div>
            <div class="smtbox2">
                <h2><span>Авто</span> в кредит</h2>
                <p>В авто центре «Колесо» Вы сможете не только выбрать автомобиль для личного пользования, но и найти транспорт для Вашего бизнеса. Мы предоставляем юридическим лицам (предприятиям малого и среднего бизнеса) максимально выгодные и комфортные условия приобретения автомобиля в лизинг, предлагая как легковые, так и грузовые автомобили и специализированные автомобили известных производителей.</p></div>
        </section>
        <section class="takecredit">
            <div class="lisingbox">
                
                <div class="credit-calculator">
                    <h3>Калькулятор автокредита</h3>
                    <div class="calculator-grid">
                        <div class="calculator-item hhh2">
                            <label for="carPrice">Цена автомобиля (₽)</label>
                            <input class="hhh" type="number" id="carPrice" value="1500000" min="100000" step="10000">
                        </div>
                        <div class="calculator-item hhh2">
                            <label for="initialPayment">Первоначальный взнос (₽)</label>
                            <input class="hhh" type="number" id="initialPayment" value="300000" min="0" step="10000">
                        </div>
                        <div class="calculator-item">
                            <label for="loanTerm">Срок кредита</label>
                            <div class="stavka">
                                <input type="range" id="loanTerm" min="12" max="84" value="36">
                                <span id="loanTermValue" class="range-value">36</span>
                                <span class="stavkatext">месяцев</span>
                            </div>
                        </div>
                        <div class="calculator-item">
                            <label for="interestRate">Годовая ставка</label>
                            <div class="stavka">
                                <input type="range" id="interestRate" min="5" max="25" step="0.1" value="12">
                                <span id="interestRateValue" class="range-value">12%</span>
                                
                            </div>
                        </div>
                        
                    </div>
                    <div class="calculator-item full-width">
                            <button class="calculate-btn" onclick="calculateLoan()">Рассчитать кредит</button>
                        </div>
                    <div class="calculator-results">
                        <div class="result-item">
                            <span class="result-label">Сумма кредита:</span>
                            <span id="loanAmount" class="result-value">1 200 000 ₽</span>
                        </div>
                        <div class="result-item">
                            <span class="result-label">Ежемесячный платеж:</span>
                            <span id="monthlyPayment" class="result-value">39 866 ₽</span>
                        </div>
                        <div class="result-item">
                            <span class="result-label">Общая сумма выплат:</span>
                            <span id="totalPayment" class="result-value">1 435 176 ₽</span>
                        </div>
                        <div class="result-item">
                            <span class="result-label">Переплата по кредиту:</span>
                            <span id="totalInterest" class="result-value">235 176 ₽</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="privilige">
            <h2><span> Преимущества </span> и особенности</h2>
            <ul class="priviligeul">
                <li class="priviligeli">
                    <div class="priviligeimg i1"></div>
                    <h3>Гибкие условия</h3>
                    <p>Выгодная цена за счёт специальных условий
                        и партнёрских программ</p>
                </li>
                <li class="priviligeli">
                    <div class="priviligeimg i2"></div>
                    <h3>Разнообразие автомобилей</h3>
                    <p>Выбирайте из широкого ассортимента автомобилей,
                        включая седаны, внедорожники и гибриды</p>
                </li>
                <li class="priviligeli">
                    <div class="priviligeimg i3"></div>
                    <h3>Служба поддержки 24/7</h3>
                    <p>Вам нужна помощь? Наша служба поддержки клиентов
                        доступна круглосуточно</p>
                </li>
                <li class="priviligeli">
                    <div class="priviligeimg i4"></div>
                    <h3>Безопасные платежи</h3>
                    <p>Будьте уверены в безопасности 
                        ваших платежей. Мы используем 
                        новейшие технологии безопасности
                         для защиты ваших данных</p>
                </li>
            </ul>
        </section>
        <section class="banking">
            <button class="banknext"></button>
            <button class="banknext before"></button>
            <h2><span>Банки</span><p>и партнеры</p></h2>
            <ul class="bankingbox d1">
                <li class="bankingli vtb" > </li>
                <li class="bankingli alpha" ></li>
                <li class="bankingli sber" ></li>
                <li class="bankingli expo" ></li>
            </ul>
            <ul class="bankingbox d2">
                <li class="bankingli psb" ></li>
                <li class="bankingli rshb" ></li>
                <li class="bankingli open" > </li>
            </ul>
        </section>
    </main>
<footer>
<div class="bg-footer">
    <div class="center footer">
            <div class="info-down">
                <a href="/base.php" class="logo down"></a>
                <p> &copy; КолесоАвтоЦентр, 2024 <br>
                Все права защищены
                </p>
            </div>
            <ul class="list down-list">
                <li class="item-down">
                    <h2 class="title footer-title">Автомобили</h2>
                        <ul class="list footer-list">
                            <li class="footer-item">Новые авто</li>
                            <li class="footer-item">Авто с пробегом</li>
                            <li class="footer-item">Новости</li>
                        </ul>
                </li>
                <li class="item-down">
                        <h2 class="title footer-title">Услуги</h2>
                            <ul class="list footer-list">
                                <li class="footer-item">Автокредит</li>
                                <li class="footer-item">Лизинг</li>
                                <li class="footer-item">Трейд-ин</li>
                            </ul>
                </li>
                <li class="item-down">
                        <h2 class="title footer-title">Сервис</h2>
                            <ul class="list footer-list">
                                <li class="footer-item">Шиномонтаж</li>
                                <li class="footer-item">Детейлинг</li>
                                <li class="footer-item">Автомойка</li>
                            </ul>
                </li>
                <li class="item-down">
                        <h2 class="title footer-title">Контакты</h2>
                            <ul class="list footer-list">
                                <li class="footer-item">+7 (903) 362-11-67</li>
                                <li class="footer-item">koleso@mail.ru</li>
                            </ul>
                </li>
            </ul>
            <ul class="list media-list">    
                <li class="media-item">
                    <a href="https://t.me/+o7Cx3DfMJZJlMzYy" aria-label="Telegram">
                        <svg class="svg-social" width="20" height="20">
                            <use href="./images/symbol-defs.svg#icon-icon-send"></use>
                        </svg>
                    </a>
                </li>
                <li class="media-item">
                    <a href="https://vk.com/club230755090" aria-label="VK">
                        <svg class="svg-social" width="20" height="20">
                            <use href="./images/symbol-defs.svg#icon-vk-svgrepo-com"></use>
                        </svg>
                    </a>
                </li>
            </ul>
    </div>
</div>
</footer>
</body>

<script>
        document.addEventListener('DOMContentLoaded', function() {
        const bank = document.querySelector('.bankingbox.d1');
        const bank2 = document.querySelector('.bankingbox.d2');
        const closeButton = document.querySelector('.banknext');
        const closeButton2 = document.querySelector('.banknext.before');
        
        // Проверка всех элементов
        if (!bank || !bank2 || !closeButton || !closeButton2) {
            console.error('Один или несколько элементов не найдены! Проверьте классы элементов.');
            return;
        }

        // Обработчики для первой кнопки
        closeButton.addEventListener('click', function(e) {
            e.preventDefault();
            bank.classList.toggle('buttonbanktop');
            bank2.classList.toggle('buttonbankbottom');
        });

        // Обработчики для второй кнопки
        closeButton2.addEventListener('click', function(e) {
            e.preventDefault();
            bank.classList.toggle('buttonbanktop');
            bank2.classList.toggle('buttonbankbottom');
        });
    });
</script>
<script>
    // Обновление значений ползунков
    document.getElementById('loanTerm').addEventListener('input', function() {
        document.getElementById('loanTermValue').textContent = this.value;
    });
    
    document.getElementById('interestRate').addEventListener('input', function() {
        document.getElementById('interestRateValue').textContent = this.value + '%';
    });
    
    // Функция расчета кредита
    function calculateLoan() {
        // Получаем значения из полей ввода
        const carPrice = parseFloat(document.getElementById('carPrice').value);
        const initialPayment = parseFloat(document.getElementById('initialPayment').value);
        const loanTerm = parseInt(document.getElementById('loanTerm').value);
        const annualInterestRate = parseFloat(document.getElementById('interestRate').value);
        
        // Проверка на корректность введенных данных
        if (initialPayment >= carPrice) {
            alert('Первоначальный взнос не может быть больше или равен цене автомобиля');
            return;
        }
        
        // Рассчитываем сумму кредита
        const loanAmount = carPrice - initialPayment;
        
        // Рассчитываем месячную процентную ставку
        const monthlyInterestRate = (annualInterestRate / 100) / 12;
        
        // Рассчитываем ежемесячный платеж по формуле аннуитета
        const monthlyPayment = (loanAmount * monthlyInterestRate) / 
                              (1 - Math.pow(1 + monthlyInterestRate, -loanTerm));
        
        // Рассчитываем общую сумму выплат
        const totalPayment = monthlyPayment * loanTerm;
        
        // Рассчитываем переплату по кредиту
        const totalInterest = totalPayment - loanAmount;
        
        // Форматируем числа для отображения
        function formatNumber(num) {
            return new Intl.NumberFormat('ru-RU', { 
                style: 'decimal', 
                maximumFractionDigits: 0 
            }).format(num);
        }
        
        // Обновляем результаты на странице
        document.getElementById('loanAmount').textContent = formatNumber(loanAmount) + ' ₽';
        document.getElementById('monthlyPayment').textContent = formatNumber(monthlyPayment.toFixed(0)) + ' ₽';
        document.getElementById('totalPayment').textContent = formatNumber(totalPayment.toFixed(0)) + ' ₽';
        document.getElementById('totalInterest').textContent = formatNumber(totalInterest.toFixed(0)) + ' ₽';
    }
    
    // Выполняем расчет при загрузке страницы
    window.onload = calculateLoan;
</script>
    
<script>
// Функция для показа уведомления
function showNotification(message, isError = false) {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.className = isError ? 'notification error' : 'notification';
    notification.style.display = 'block';
    
    // Автоматическое скрытие через 3 секунды
    setTimeout(() => {
        notification.style.display = 'none';
    }, 3000);
}

// Функция для отправки заявки на консультацию
function submitConsultation() {
    <?php if (isset($_SESSION['user_id'])): ?>
        // Если пользователь авторизован - отправляем форму
        document.getElementById('consultationForm').submit();
    <?php else: ?>
        // Если не авторизован - показываем уведомление
        showNotification('Для подачи заявки необходимо авторизоваться', true);
        // Перенаправляем на страницу авторизации через 3 секунды
        setTimeout(() => {
            window.location.href = '/base.php#reg';
        }, 3000);
    <?php endif; ?>
}
</script>
<script>
// Показываем сообщения об ошибках/успехе
<?php if (!empty($errors)): ?>
    <?php foreach ($errors as $error): ?>
        showNotification('<?php echo addslashes($error); ?>', true);
    <?php endforeach; ?>
<?php endif; ?>

<?php if (!empty($success_messages)): ?>
    <?php foreach ($success_messages as $message): ?>
        showNotification('<?php echo addslashes($message); ?>');
    <?php endforeach; ?>
<?php endif; ?>
</script>    
</html>