<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?php echo $this->article->title; ?></title>
    <style>
        article h1 {
            color: red;
        }
    </style>
</head>

<body>

<article>
    <h1><?php echo $this->article->title; ?></h1>
    <div><?php echo $this->article->lead; ?></div>
    <p><?php echo isset($this->article->author) ? $this->article->author->name : '' ?></p>
</article>

</body>

</html>