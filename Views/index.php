<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>


    <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css">
    <script type="text/javascript" src="/fancybox/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="/fancybox/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="/fancybox/jquery.fancybox-1.2.1.pack.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("a.first").fancybox();
        });
    </script>



</head>

<body>

<h1>Главная страница</h1>

5 последних загруженных фотографий:
<?php //var_dump($this); ?>
<?php foreach ($this->images as $item): ?>
<table border="1">
    <tr>
        <th><?php echo $item->title; ?></th>
        <th>Дата загрузки фотографии</th>
    </tr>
    <tr>
        <td><a class="first" title="<?php echo $item->textimg ?>" href="<?php echo $item->path ?>"><img src="<?php echo $item->path ?>"
        title="<?php echo $item->textimg; ?>" style="max-width:200px;"></a></td>
        <th><?php echo $item->date; ?></th>
    </tr>
    <?php endforeach; ?>
</table>


<br>


</body>

</html>