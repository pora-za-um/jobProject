<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Редактирование фото</title>

    <link rel="stylesheet" type="text/css" href="/../../fancybox/jquery.fancybox.css">
    <script type="text/javascript" src="/../../fancybox/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="/../../fancybox/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="/../../fancybox/jquery.fancybox-1.2.1.pack.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("a.first").fancybox();
        });
    </script>

</head>

<body>

<h3>Редактирование фото</h3>



<?php foreach ($this->photo as $item): ?>

    <a class="first" title="<?php echo $item->textimg ?>" href="<?php echo $item->path ?>"><img src="<?php echo $item->path ?>"
    title="<?php echo $item->textimg; ?>" style="max-width:200px;"></a><br>

    <?php echo 'Название - ' . $item->title; ?><br>
    <?php echo 'Описание - ' . $item->textimg; ?><br>
    <?php echo 'Дата загрузки - ' . $item->date; ?><br><br>

    <?php $_SESSION['id_photo'] = $item->id; ?>

<?php endforeach; ?>

<form action="/../file/edit" method="post">
    Изменить название: <input type="text" name="title">
    Изменить описание: <input type="text" name="textimg">
    <input type="submit">
</form>


<br>

<a href='/../'>На главную страницу</a>

</body>

</html>