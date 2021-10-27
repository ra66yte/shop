<!doctype html>
<html lang="en">
<body>
<h2>Здравствуйте, {{ $mail_data['name'] }}!</h2>
<div>
    <p>Вы запросили повторное письмо для подтверждения заказа в интернет магазине {{ env('APP_NAME') }}.</p>
    <p>Для того чтобы подтвердить заказ перейдите по ссылке <a href="{{ $mail_data['activate_link'] }}">{{ $mail_data['activate_link'] }}</a></p>
    <p>Спасибо, что воспользовались нашим сервисом.<br>С уважением, команда {{ env('APP_NAME') }}.</p>
</div>
</body>
</html>
