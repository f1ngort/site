
        // Анимация появления элементов при загрузке и скролле
        document.addEventListener('DOMContentLoaded', () => {
            const fadeElements = document.querySelectorAll('.fade-in');
            
            // Функция проверки видимости элемента
            const checkVisibility = () => {
                fadeElements.forEach(el => {
                    const rect = el.getBoundingClientRect();
                    const isVisible = (rect.top <= window.innerHeight * 0.8);
                    
                    if (isVisible) {
                        el.classList.add('visible');
                    }
                });
            };

            // Запуск при загрузке
            checkVisibility();
            
            // Запуск при скролле
            window.addEventListener('scroll', checkVisibility);
        });Я
