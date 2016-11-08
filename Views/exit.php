<?php
session_start();
if    (empty($_SESSION['login']) or empty($_SESSION['password']))
{
    //если не существует сессии с логином и паролем, значит на этот файл попал невошедший пользователь. Ему тут не место. Выдаем сообщение об ошибке, останавливаем скрипт
    exit ("Доступ на эту страницу разрешен только зарегистрированным пользователям. Если вы зарегистрированы, то войдите на сайт под своим логином и паролем<br>
<a href='/../'>На главную страницу</a>");
}
else {

    unset($_SESSION['password']);
    unset($_SESSION['login']);
    unset($_SESSION['id']);

    header('Location: /../');
}

?>