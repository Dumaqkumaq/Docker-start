<?php session_start(); ?>
<!DOCTYPE html>
<html lang = 'ru'>
<head>
    <!-- Позаимствовал стили у кого-то в инете. Думаю, понадобятся-->
    <title>Выгрузка API</title>
    <style>
        .error-message {
            background: #ffebee;
            color: #c62828;
            padding: 12px;
            border-radius: 4px;
            margin: 10px 0;
            border-left: 4px solid #c62828;
        }
        
        .success-message {
            background: #e8f5e8;
            color: #2e7d32;
            padding: 12px;
            border-radius: 4px;
            margin: 10px 0;
            border-left: 4px solid #2e7d32;
        }
        
        .refresh-btn {
            background: #2196f3;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin: 10px 0;
        }
        
        .refresh-btn:hover {
            background: #1976d2;
        }
        
        .refresh-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
        
        .loading {
            opacity: 0.6;
        }
    </style>
</head>
<body>
     <!-- Посмотрел в инете про дивы -->
    <?php if (isset($_COOKIE['last_submission'])): ?>
        <div style="background: #f0f0f0; padding: 10px; margin-bottom: 20px;">
            <p>Последняя отправка формы: <?php echo htmlspecialchars($_COOKIE['last_submission']); ?></p>
        </div>
    <?php endif; ?>
    <?php if(isset($_SESSION['username'])): ?>
        <div style="background: #f0f0f0; padding: 10px; margin-bottom: 20px;">
            <ul>
                <?php echo"<h3>Данные о пользователе:</h3>"?>
                <li>Имя: <?= $_SESSION['username'] ?></li>
                <li>Email: <?= $_SESSION['email'] ?></li>
                <?php   
                require_once 'UserInfo.php';
                $info = UserInfo::getInfo();

                foreach ($info as $key => $val) {
                    echo "<li>" . htmlspecialchars($key) . ': ' . htmlspecialchars($val) . '<br></li>';
                }
            ?>
            </ul>
    </div>
    <!-- Кнопка обновления данных -->
    <button id="refreshBtn" class="refresh-btn">Обновить данные</button>
    <div class="button-container">
    <a href="form.html">Заполнить форму</a>
    <a href="view.php">Посмотреть все данные</a>
    </div>  

</div>
    <!-- Блок для сообщений -->
    <div id="messageContainer"></div>
    <div id="api-data">
        <?php
        function displayApiData($data){
        if (isset($_SESSION['api_data'])) {
            echo "<h3>Данные из API:</h3>";
            echo "<pre>" . print_r($_SESSION['api_data'], true) . "</pre>";
        } else {
                echo '<div class="error-message">Ошибка в данных API</div>';
            }
    }
        // Вывод данных из сессии
        if (isset($_SESSION['api_data']) && is_array($_SESSION['api_data'])) {
            displayApiData($_SESSION['api_data']);
            unset($_SESSION['api_data']);
        } elseif (isset($_SESSION['api_error'])) {
            echo '<div class="error-message">Ошибка: ' . htmlspecialchars($_SESSION['api_error']) . '</div>';
            unset($_SESSION['api_error']);
        }
         if(isset($_SESSION['errors'])): ?>
            <ul style="color:red;">
                <?php foreach($_SESSION['errors'] as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            <?php unset($_SESSION['errors']); ?>
        <?php endif; ?>
        <?php else: ?>
            <p>Данных пока нет.</p>
        <?php endif; ?>



<script>
        document.addEventListener('DOMContentLoaded', function() {
            const refreshBtn = document.getElementById('refreshBtn');
            const messageContainer = document.getElementById('messageContainer');
            const apiDataContainer = document.getElementById('api-data');
            
            refreshBtn.addEventListener('click', function() {
                // Показываем состояние загрузки
                refreshBtn.disabled = true;
                refreshBtn.textContent = 'Обновление...';
                apiDataContainer.classList.add('loading');
                
                // Очищаем предыдущие сообщения
                messageContainer.innerHTML = '';
                
                // Выполняем AJAX-запрос
                fetch('update_api.php')
                    .then(response => {
                        // Сначала получаем текст, чтобы проверить формат
                        return response.text().then(text => {
                            try {
                                // Пытаемся распарсить как JSON
                                return JSON.parse(text);
                            } catch (e) {
                                // Если не JSON, бросаем ошибку с текстом ответа
                                throw new Error('Сервер вернул не JSON: ' + text.substring(0, 100));
                            }
                        });
                    })
                    .then(data => {
                        if (data.success) {
                            // Показываем сообщение об успехе
                            showMessage('Данные успешно обновлены!', 'success');
                            
                            // Обновляем данные на странице
                            updateApiDisplay(data.data);
                        } else {
                            throw new Error(data.message);
                        }
                    })
                    .catch(error => {
                        // Показываем сообщение об ошибке
                        showMessage('Ошибка при обновлении: ' + error.message, 'error');
                        console.error('Fetch error:', error);
                    })
                    .finally(() => {
                        // Восстанавливаем кнопку
                        refreshBtn.disabled = false;
                        refreshBtn.textContent = 'Обновить данные';
                        apiDataContainer.classList.remove('loading');
                    });
            });
            
            function showMessage(message, type) {
                const messageDiv = document.createElement('div');
                messageDiv.className = type === 'error' ? 'error-message' : 'success-message';
                messageDiv.textContent = message;
                messageContainer.appendChild(messageDiv);
                
                // Автоматически скрываем сообщение через 5 секунд
                setTimeout(() => {
                    if (messageDiv.parentNode) {
                        messageDiv.remove();
                    }
                }, 5000);
            }
        function updateApiDisplay(data) {
                let html = '';
    
                // Пропарсил на категории в ии
                html += '<h3>Отладочная информация:</h3>';
                html += '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
                
                // Затем попробуем отобразить данные
                if (data && data.success && data.data && data.data.categories) {
                    html += '<h2>Food Categories</h2>';
                    data.data.categories.forEach(category => {
                        html += `<p><strong>${category.strCategory}</strong>: ${category.strCategoryDescription.substring(0, 50)}...</p>`;
                    });
                }
                
                apiDataContainer.innerHTML = html;
            }
        });
</script>
</body>