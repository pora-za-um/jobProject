<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Отображение списка пользователей</title>
</head>
<body>

<h3>Список пользователей, выложивших хотя бы одну фотографию:</h3>

<?php foreach ($this->users as $item): ?>

    <a href="/photos/user/?id=<?php echo $item->user_id; ?>">
        <?php echo $item->login; ?></a>

<br>


<?php endforeach; ?>

</body>
</html>