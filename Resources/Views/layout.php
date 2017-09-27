<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $page->title ?></title>
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>

<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login / Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <article id="page-content">
		<?= $content ?>
        <!--<app></app>-->
    </article>
</div>

<script src="/assets/js/app.js"></script>
</body>
</html>