<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?php echo 'Все фотографии пользователя'; ?></title>

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

Все фотографии пользователя:

<table border="1">
<?php foreach ($this->user as $item): ?>
    <tr>
        <th><?php echo $item->title; ?></th>
        <th>Дата загрузки фотографии</th>

    </tr>
    <tr>

        <td><a class="first" title="<?php echo $item->textimg ?>" href="<?php echo $item->path ?>"><img src="<?php echo $item->path ?>"
        title="<?php echo $item->textimg; ?>" style="max-width:200px;"></a></td>
        <th><?php echo $item->date; ?></th>

        <?php if ($_SESSION['id'] == $_GET['id'] || ($_SESSION['login'] == 'admin')): ?>
        <td><a href="/../../photos/delete/?id=<?php echo $item->id; ?>">Удалить</a><br><br>
            <a href="/../../photos/edit/?id=<?php echo $item->id; ?>">Редактировать</a>


        </td>
        <?php endif; ?>
    </tr>

        <?php endforeach; ?>
</table>



<br><a href='/../'>На главную страницу</a>

</body>

</html>