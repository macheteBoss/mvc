<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <!-- Bootstrap CSS (Cloudflare CDN) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
        <link rel="stylesheet" href="/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/style.css">
        <!-- jQuery (Cloudflare CDN) -->
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Bootstrap Bundle JS (Cloudflare CDN) -->
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body>
        <header>
            <div class="container">
                Тестовое задание! Надеюсь на положительное решение!)
            </div>
        </header>
        <div id="content">
            <div class="container">
                <?php include 'code/views/'. $content_view; ?>
            </div>
        </div>
    </body>
</html>