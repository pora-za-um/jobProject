<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
</head>
<body>


<?php if (empty($_SESSION['login']) || empty($_SESSION['password'])) { ?>

    <form action="/../index/login" method="post">
        Логин: <input type="text" name="login">
        Пароль: <input type="password" name="password">
        <input type="submit">
    </form>
    <br>
    <a href="/../views/form_registration.html">Регистрация</a>

    <?php
} else {
    echo "Вы вошли на сайт, как " . $_SESSION['login'];
    $id = $_SESSION['id']; ?>
    <br><a href="/profile/page/?id=<?php echo $id; ?>">Ваш профиль</a><br><a href="/views/exit.php">Выход</a>

<?php } ?>


</body>
</html>