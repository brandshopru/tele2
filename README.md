# PHP клиент для API сервиса оповещения [TELE2](https://tele2.ru/).
Пакет предоставляет удобный интерфейс для интеграции с сервисом оповещения SMS. 
## Требования
* php ^7.1
* guzzlehttp/guzzle ^6.0.0

## Установка
Вы можете установить данный пакет с помощью сomposer:

```
composer require brandshopru/tele2
```

## Использование
Допустим нам необходимо отправить смс-сообщение:
```php
use Brandshopru\Tele2\Client;

$login = 'Tele2Login';
$password = 'Tele2Password';

$Tele2Client = new Client($login, $password);

$phone = "+76543210987";
$message = "Привет, нам не хватает только тебя ;)";
$brandsname = "BRANDSHOP";

try {
    $result = $Tele2Client->sendSms($phone, $message, $brandsname);
    if ($result->isOk()) {
        // сообщение отправлено
        $details = $result->getContent();
    } else {
        // что-то пошло не так
    }
} catch (Exception $error) {
    //обрабатываем исключение
}
```
