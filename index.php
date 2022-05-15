<div>
    <form action="/" method="GET">
        <p style="font-size: 14px">Логин</p>
        <input name="login" value="">
        <p style="font-size: 14px">Пароль</p>
        <input name="password" value="">
        <p style="font-size: 14px">Сообщение</p>
        <input name="message">
        <button>Отправить</button>
    </form>
</div>

<?php
$users = [
    "admin" => "admin",
    "guest" => "123"
];

function add_msg($login, $message)
{
    if ($message !== '') {
        $info = json_decode(file_get_contents('data.json'));
        $newMessage = (object)['date' => date('d.m.y h:i:s'), 'user' => $login, 'message' => $message];
        $info[] = $newMessage;
        file_put_contents('data.json', json_encode($info));
    }
}

function print_msgs()
{
    $info = json_decode(file_get_contents('data.json'));
    foreach ($info as $msg) {
       echo '<p font-weight: bold">' . $msg->date . ' | ' . $msg->user . ' say:';
        echo '<p style="padding-left: 125px">' . $msg->message;
    }
}



if (isset($_GET['login']) && isset($_GET['password']) && isset($_GET['message'])) {
    $log = (string)$_GET['login'];
    $pas = (string)$_GET['password'];
    $msg = (string)$_GET['message'];

    if ($users[$log] == $pas) {
        add_msg($log, $msg);
    } else {
        echo '<p font-weight: bold">' . 'Wrong password';
    }
    header('Refresh: 0; url=index.php');
}


print_msgs();
?>

