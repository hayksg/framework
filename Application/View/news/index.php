<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Hello</title>
        <link href="/css/style.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <?php foreach ($allNews as $news) : ?>
            <h3><?= $news->title; ?></h3>
            <p><?= $news->short_content; ?></p>
        <?php endforeach; ?>
    </body>
</html>
