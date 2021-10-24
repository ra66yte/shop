<!doctype html>
<html lang="en">
<body>

<h2>Здравствуйте, {{ $mail_data['name'] }}!</h2>
<div>
    <p>Вы сделали заказ в интернет магазине {{ env('APP_NAME') }}.</p>
    @switch ($mail_data['user_type'])
        @case(0)
            <p>Для Вас была создана учетная запись, для того, чтобы Вы могли получить доступ к заказу и следить за его состоянием.
                <br>
                Запишите ваши данные для входа:
                <ul>
                    <li>Логин: <b>{{ $mail_data['email'] }}</b></li>
                    <li>Пароль: <b>{{ $mail_data['password'] }}</b></li>
                </ul>
                Обязательно смените свой пароль в настройках.
            </p>
            @break
        @case(1)
            <p>Система определила, что у Вас уже есть учетная запись. Используйте свои логин и пароль чтобы получить доступ к заказу и следить за его статусом.</p>
            @break
        @case(2)
            @break
        @default
            @break
    @endswitch
    <p>Для того чтобы подтвердить заказ перейдите по <a href="{{ $mail_data['activate_link'] }}">{{ $mail_data['activate_link'] }}</a></p>
    <p>Спасибо, что воспользовались нашим сервисом. <br>С уважением, команда {{ env('APP_NAME') }}</p>
</div>
</body>
</html>
