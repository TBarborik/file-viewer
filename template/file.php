<!doctype html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Semi+Condensed:300,400,700&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="media/css/prism.css">
    <link rel="stylesheet" href="media/css/app.css">
    <title>FileManager &bull; showing file content</title>
</head>
<body class="file">
    <h1>Showing content <small><?php echo $filePath; ?></small></h1>
    <?php if (isset($fileInfo["extension"]) && in_array($fileInfo["extension"], $imgExtensions)) { ?>
        <div class="image-wrapper">
            <img src="<?php echo $filePath; ?>">
        </div>
    <?php } else { ?>
        <pre><code class="language-<?php echo $fileInfo["extension"]; ?> line-numbers"><?php echo $fileContent; ?></code></pre>
        <script type="text/javascript" src="media/js/prism.js"></script>
    <?php } ?>
</body>
</html>

