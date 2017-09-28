<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $page->title ?></title>
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>

<div id="app">

	<?php if ( app::auth() ) { require_once "includes/upload.php"; } ?>
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
	                <?php
	                if ( app::auth() ) {
		                ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/images">My Images</a>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link btn btn-outline-success" data-toggle="modal" data-target="#exampleModal">Upload image</button>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout"><i class="fa fa-sign-out"></i></a>
                        </li>
		                <?php
	                }else {
		                ?>
                        <li class="nav-item">
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