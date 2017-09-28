<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $page->title ?></title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body id="root">

<div id="app">


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <a class="navbar-brand" href="/">
                <img width="30px" src="/assets/images/logo.png"/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
	                <?php
	                if ( app::auth() ) {
		                ?>
                        <li class="nav-item <?= app::current() == '/images' ? 'active' : '' ?>">
                            <a class="nav-link" href="/images">MY IMAGES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout"><i class="fa fa-sign-out"></i></a>
                        </li>
		                <?php
	                }else {
		                ?>
                        <li class="nav-item <?= app::current() == '/login' ? 'active' : '' ?>">
                            <a class="nav-link" href="/login">Login / Register</a>
                        </li>
		                <?php
                    }
	                ?>
                </ul>
            </div>
        </div>
    </nav>

    <article id="page-content">

        <div class="container">
            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" id="myModal" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        ...
                    </div>
                </div>
            </div>
        </div>

		<?= $content ?>
        <!--<app></app>-->
    </article>
</div>

<script src="/assets/js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>