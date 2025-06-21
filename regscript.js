document.addEventListener('DOMContentLoaded', function() {
    // Анимация элементов
    function animateElement(element) {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'opacity 0.4s ease-out, transform 0.4s ease-out';
        
        setTimeout(() => {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, 10);
    }

    // Анимация форм при загрузке
    const authForms = document.querySelectorAll('.auth-form');
    authForms.forEach(animateElement);

    // Переключение между вкладками
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.dataset.tab;
            
            // Обновление активных элементов
            document.querySelectorAll('.tab-btn, .auth-form').forEach(el => {
                el.classList.remove('active');
                if (el.classList.contains('auth-form')) {
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(20px)';
                }
            });
            
            this.classList.add('active');
            const activeForm = document.getElementById(`${tabId}-form`);
            activeForm.classList.add('active');
            animateElement(activeForm);
        });
    });
    
    // Обработка формы входа
    document.getElementById('login-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch('login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
            }
            return response.text();
        })
        .then(text => {
            if (text.includes('error')) {
                showError('Ошибка авторизации');
            }
        })
        .catch(() => showError('Ошибка соединения'));
    });
    
    // Обработка формы регистрации
    document.getElementById('register-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch('register.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showModal();
            } else {
                showError(data.message || 'Ошибка регистрации');
            }
        })
        .catch(() => showError('Ошибка соединения'));
    });

    // Вспомогательные функции
    function showError(message) {
        const errorElement = document.createElement('div');
        errorElement.className = 'error-message';
        errorElement.textContent = message;
        document.body.appendChild(errorElement);
        setTimeout(() => errorElement.remove(), 3300);
    }

    function showModal() {
        const modal = document.getElementById('success-modal');
        modal.style.display = 'flex';
        setTimeout(() => modal.style.opacity = '1', 10);
    }

    // Закрытие модального окна
    document.querySelector('.close-modal').addEventListener('click', closeModal);
    document.getElementById('go-to-login').addEventListener('click', () => {
        closeModal();
        document.querySelector('[data-tab="login"]').click();
    });
    window.addEventListener('click', e => {
        if (e.target === document.getElementById('success-modal')) closeModal();
    });

    function closeModal() {
        const modal = document.getElementById('success-modal');
        modal.style.opacity = '0';
        setTimeout(() => modal.style.display = 'none', 300);
    }
});