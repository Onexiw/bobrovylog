<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тест виджета в iframe</title><?php
// thanks.php - страница благодарности за покупку билета
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

$APPLICATION->SetTitle("Спасибо за покупку!");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: linear-gradient(135deg, #f5f7fa 0%, #e9edf5 100%);
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container { 
            max-width: 600px; 
            width: 100%;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            text-align: center;
        }
        .success-icon {
            font-size: 80px;
            margin-bottom: 20px;
            display: block;
        }
        h1 {
            color: #28a745;
            font-size: 32px;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #666;
            font-size: 18px;
            margin-bottom: 30px;
        }
        .order-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            text-align: left;
            margin-bottom: 30px;
        }
        .order-info p {
            margin: 8px 0;
            color: #333;
        }
        .order-info strong {
            color: #007bff;
        }
        .btn {
            display: inline-block;
            padding: 15px 50px;
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(40,167,69,0.3);
        }
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(40,167,69,0.4);
        }
        .email-sent {
            background: #e8f5e9;
            border-radius: 12px;
            padding: 25px;
            margin-top: 25px;
            font-size: 20px;
            line-height: 1.6;
            color: #2e7d32;
        }
        .email-sent small {
            display: block;
            margin-top: 8px;
            font-size: 16px;
            color: #555;
        }
    </style>
    
    <?$APPLICATION->AddHeadScript('https://sale.moipass.ru/external.script.js');?>
</head>
<body>
    <div class="container">
        <span class="success-icon">✅</span>
        
        <h1>Спасибо за покупку!</h1>
        <p class="subtitle">Ваш билет успешно оплачен и ожидает вас</p>
        
        <div class="order-info">
            <p><strong>Дата:</strong> <?= date('d.m.Y H:i'); ?></p>
            <p><strong>Статус:</strong> <span style="color: #28a745;">✅ Оплачен</span></p>
        </div>
        
        <div class="email-sent">
            📧 Электронный билет отправлен на вашу почту
            <small>Проверьте папку «Спам», если письмо не пришло</small>
        </div>
        
        <div style="margin-top: 30px;">
            <a href="/" class="btn">🏠 На главную</a>
        </div>
    </div>

    <script>
        let scriptLoaded = false;
        let checkCount = 0;
        const maxChecks = 10;
        
        function updateStatus(message) {
            console.log('[Widget] ' + message);
        }
        
        function checkWidgetScript() {
            checkCount++;
            
            if (typeof WPInit !== 'undefined') {
                scriptLoaded = true;
                updateStatus('✅ Скрипт виджета загружен');
                
                try {
                    WPInit({
                        id: 537,
						// groupid: 20214214,  
						// onlytab: ["service", "rewrite"],
						onlytab: "rewrite",
						// forcetab: "rewrite",
                        height: 700,
                        width: 1200,
                        type: 'modal',
                        nopromo: true,
                        locale: 'ru'
                    });
                    updateStatus('✅ Виджет инициализирован');
                } catch (error) {
                    updateStatus('❌ Ошибка инициализации: ' + error.message);
                }
                
            } else if (checkCount >= maxChecks) {
                updateStatus('❌ Скрипт виджета не загрузился');
            } else {
                setTimeout(checkWidgetScript, 1000);
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(checkWidgetScript, 2000);
            
            const icon = document.querySelector('.success-icon');
            if (icon) {
                icon.style.transition = 'transform 0.6s ease';
                setTimeout(() => {
                    icon.style.transform = 'scale(1.2)';
                }, 300);
                setTimeout(() => {
                    icon.style.transform = 'scale(1)';
                }, 900);
            }
        });
    </script>
</body>
</html>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?><?php
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>