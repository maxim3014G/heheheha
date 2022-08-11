<?php
$ nohup php -q script.php > script.log 2>&1 &
$ php -q script.php < /dev/null > script.log &

//В переменную $token нужно вставить токен, который нам прислал @botFather
$token = "5521926012:AAGIXjuHXa2JkCvoUPg2RJZ_kOyKdNU4dOs";

//Сюда вставляем chat_id
$chat_id = "-40XXXX740";

//Определяем переменные для передачи данных из нашей формы
if ($_POST['act'] == 'order') {
    $name = ($_POST['user_name']);
    $phone = ($_POST['user_phone']);
    $email = ($_POST['user_email']);
    $info = ($_POST['user_info']);
    $type = ($_POST['user_type']);

//Собираем в массив то, что будет передаваться боту
    $arr = array(
        'Имя пользователя: ' => $name,
        'Телефон: ' => $phone,
        'Email' => $email,
        'Доп.Инфа' => $info,
        'Тип проекта' => $type
    );

//Настраиваем внешний вид сообщения в телеграме
    foreach($arr as $key => $value) {
        $txt .= "<b>".$key."</b> ".$value."%0A";
    };

//Передаем данные боту
    $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

//Выводим сообщение об успешной отправке
    if ($sendToTelegram) {
        alert('Спасибо! Ваша заявка принята. Мы свяжемся с вами в ближайшее время.');
    }

//А здесь сообщение об ошибке при отправке
    else {
        alert('Что-то пошло не так. ПОпробуйте отправить форму ещё раз.');
    }
}

?>