document.addEventListener('DOMContentLoaded', function() {
    const quizForm = document.getElementById('quiz-form');
    const submitBtn = document.getElementById('submit-btn');
    const resultsDiv = document.getElementById('results');
    const scoreSpan = document.getElementById('score');
    const resultMessage = document.getElementById('result-message');
    const retryBtn = document.getElementById('retry-btn');
    const progress = document.getElementById('progress');
    const questions = document.querySelectorAll('.question');
    const nextButtons = document.querySelectorAll('.next-btn');
    const prevButtons = document.querySelectorAll('.prev-btn');

    // Правильные ответы
    const correctAnswers = {
        q1: 'b', q2: 'b', q3: 'a', q4: 'a', q5: 'a',
        q6: 'a', q7: 'a', q8: 'a', q9: 'a', q10: 'a',
        q11: 'b', q12: 'a', q13: 'a', q14: 'a', q15: 'a'
    };

    // Добавляем классы для анимации
    function initAnimations() {
        // Анимация для заголовка
        document.querySelector('.test-container h1').style.opacity = '0';
        document.querySelector('.test-container h1').style.transform = 'translateY(20px)';
        document.querySelector('.test-container h1').style.transition = 'opacity 1s ease-out, transform 1s ease-out';
        
        // Анимация для прогресс-бара
        progress.parentElement.style.opacity = '0';
        progress.parentElement.style.transform = 'translateY(20px)';
        progress.parentElement.style.transition = 'opacity 0.5s ease-out 0.2s, transform 0.5s ease-out 0.2s';
        
        // Анимация для вопросов
        questions.forEach(question => {
            question.style.opacity = '0';
            question.style.transform = 'translateY(20px)';
            question.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
        });
        
        // Запускаем анимации после небольшой задержки
        setTimeout(() => {
            document.querySelector('.test-container h1').style.opacity = '1';
            document.querySelector('.test-container h1').style.transform = 'translateY(0)';
            
            progress.parentElement.style.opacity = '1';
            progress.parentElement.style.transform = 'translateY(0)';
            
            // Анимируем только активный вопрос
            const activeQuestion = document.querySelector('.question.active');
            if (activeQuestion) {
                activeQuestion.style.opacity = '1';
                activeQuestion.style.transform = 'translateY(0)';
            }
        }, 100);
    }
    // Инициализируем анимации
    initAnimations();

    // Показываем первый вопрос
    questions[0].classList.add('active');

    // Обработчики кнопок "Далее"
    nextButtons.forEach(button => {
        button.addEventListener('click', function() {
            const currentQuestion = this.closest('.question');
            const nextQuestionId = currentQuestion.id.replace('q', '');
            const nextQuestion = document.getElementById(`q${parseInt(nextQuestionId) + 1}`);
            
            // Анимация перехода между вопросами
            currentQuestion.style.opacity = '0';
            currentQuestion.style.transform = 'translateX(-20px)';
            
            setTimeout(() => {
                currentQuestion.classList.remove('active');
                nextQuestion.classList.add('active');
                
                // Сброс стилей перед анимацией
                nextQuestion.style.opacity = '0';
                nextQuestion.style.transform = 'translateX(20px)';
                
                // Даем время для применения сброшенных стилей
                setTimeout(() => {
                    nextQuestion.style.opacity = '1';
                    nextQuestion.style.transform = 'translateX(0)';
                }, 10);
                
                updateProgressBar();
            }, 300);
        });
    });

    // Обработчики кнопок "Назад"
    prevButtons.forEach(button => {
        button.addEventListener('click', function() {
            const currentQuestion = this.closest('.question');
            const prevQuestionId = currentQuestion.id.replace('q', '');
            const prevQuestion = document.getElementById(`q${parseInt(prevQuestionId) - 1}`);
            
            // Анимация перехода между вопросами
            currentQuestion.style.opacity = '0';
            currentQuestion.style.transform = 'translateX(20px)';
            
            setTimeout(() => {
                currentQuestion.classList.remove('active');
                prevQuestion.classList.add('active');
                
                // Сброс стилей перед анимацией
                prevQuestion.style.opacity = '0';
                prevQuestion.style.transform = 'translateX(-20px)';
                
                // Даем время для применения сброшенных стилей
                setTimeout(() => {
                    prevQuestion.style.opacity = '1';
                    prevQuestion.style.transform = 'translateX(0)';
                }, 10);
            }, 300);
        });
    });

    // Отправка формы
    submitBtn.addEventListener('click', function(e) {
        e.preventDefault();
        calculateScore();
    });

    // Повторное прохождение теста
    retryBtn.addEventListener('click', function() {
        // Анимация скрытия результатов
        resultsDiv.style.opacity = '0';
        resultsDiv.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            quizForm.reset();
            resultsDiv.style.display = 'none';
            quizForm.style.display = 'block';
            
            questions.forEach((question, index) => {
                question.classList.remove('active');
                if (index === 0) question.classList.add('active');
                
                // Сброс анимации для вопросов
                question.style.opacity = '0';
                question.style.transform = 'translateY(20px)';
            });
            
            progress.style.width = '0%';
            
            // Анимация появления первого вопроса
            setTimeout(() => {
                const firstQuestion = document.querySelector('.question.active');
                if (firstQuestion) {
                    firstQuestion.style.opacity = '1';
                    firstQuestion.style.transform = 'translateY(0)';
                }
            }, 100);
        }, 300);
    });

    // Обновление прогресс-бара
    function updateProgressBar() {
        const answered = document.querySelectorAll('input[type="radio"]:checked').length;
        const progressPercent = (answered / 15) * 100;
        progress.style.width = `${progressPercent}%`;
    }

    // Подсчет результатов
    function calculateScore() {
        let score = 0;
        const formData = new FormData(quizForm);

        for (let [name, value] of formData.entries()) {
            if (correctAnswers[name] === value) {
                score++;
            }
        }

        // Анимация скрытия формы
        quizForm.style.opacity = '0';
        quizForm.style.transform = 'translateY(-20px)';
        
        setTimeout(() => {
            // Показываем результаты
            quizForm.style.display = 'none';
            resultsDiv.style.display = 'block';
            
            // Подготовка к анимации
            resultsDiv.style.opacity = '0';
            resultsDiv.style.transform = 'translateY(20px)';
            
            scoreSpan.textContent = score;

            // Формируем сообщение в зависимости от результата
            const percentage = (score / 15) * 100;

            if (percentage >= 85) {
                resultMessage.textContent = 'Отличный результат! Вы отлично знаете все стандарты работы повара в Rostic\'s!';
            } else if (percentage >= 60) {
                resultMessage.textContent = 'Хороший результат! Вам нужно повторить некоторые аспекты работы.';
            } else {
                resultMessage.textContent = 'Необходимо дополнительное обучение. Обратите особое внимание на стандарты работы.';
            }
            
            // Анимация появления результатов
            setTimeout(() => {
                resultsDiv.style.opacity = '1';
                resultsDiv.style.transform = 'translateY(0)';
            }, 10);
        }, 300);
    }

    // Обновление прогресс-бара при выборе ответов
    quizForm.addEventListener('change', updateProgressBar);
});