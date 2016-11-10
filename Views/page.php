<?php
session_start();
if (($_SESSION['id']) == $_GET['id'] || ($_SESSION['login'] == 'admin')) {$id =$_GET['id'];}
else
{ exit("Несуществующая страница");}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?php echo 'Профиль пользователя'; ?></title>

</head>

<body>
<a href='/../'>На главную страницу</a><br><br>

<?php if (($_SESSION['login']) == 'admin'): echo 'Привет, ' . $_SESSION['login'] . '!<br><br>'; ?>


<?php endif; ?>

<?php foreach ($this->user as $value): ?>
    <?php echo 'Ваш логин: ' . $value->login; ?><br>
    <?php echo 'Ваш email: ' . $value->email; ?><br>
    <?php echo 'Ваша информация: ' . $value->information; ?><br>
    <?php echo 'Количество загруженных фотографий: ' . $value->img_count; ?><br><br>

    <?php $_SESSION['id'] = $_GET['id']; ?>


    <form action="/../Profile/EditInformation" method="post">
        Изменить пароль: <input type="password" name="password"><br>
        Изменить email: <input type="email" name="email"><br>
        Изменить информацию: <input type="information" name="information"><br>
        <input type="submit" value="Поменять">
    </form>

    <?php if ($value->img_count >0):

        //echo '!!!<br>';









    endif; ?>
    <br>
<?php endforeach; ?>


</body>

</html>
