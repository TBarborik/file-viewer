<?php if (!isset($show_template) || !$show_template) exit(); ?>

<!doctype html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Semi+Condensed:300,400,700&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="media/css/jquery.fancybox.css">
    <link rel="stylesheet" href="media/css/app.css">
    <script type="text/javascript" src="media/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="media/js/jquery.fancybox.min.js"></script>
    <title>FileViewer</title>
</head>
<body class="base">
<div id="content-wrapper">
    <header>
        <h1>FileViewer
            <small><?php echo $dir; ?></small>
        </h1>
    </header>
    <article>
        <?php foreach ($dirContent as $content) { ?>
            <?php if ($content["type"] == "directory") { ?>
                <div class="item directory">
                    <a href="?dir=<?php echo urlencode($content["fullPath"]); ?>" title="go">
                        <?php echo $content["name"]; ?>
                    </a>
                </div>
            <?php } ?>
        <?php } ?>


        <?php foreach ($dirContent as $content) { ?>
            <?php if ($content["type"] == "file") { ?>
                <div class="item file">
                    <a href="?action=show&file=<?php echo urlencode($content["fullPath"]); ?>" title="show" data-fancybox data-type="iframe">
                        <?php echo $content["name"]; ?>
                    </a>
                </div>
            <?php } ?>
        <?php } ?>
    </article>
</div>
</body>
</html>
