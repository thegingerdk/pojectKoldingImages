<div class="container">
    <div class="row">
        <div class="col">
            <div class="jumbotron">
                <h1><?= $page->title ?></h1>
            </div>
        </div>
    </div>
    <div class="row">
		<?php foreach ( $page->pictures as $picture ) { ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="card">
                    <?php if(isset($page->delete) && $page->delete) { ?>
                        <a class="delete-btn" href="/api/picture/delete?pid=<?= $picture->ID ?>"><i class="fa fa-trash"></i></a>
                    <?php }?>
                    <img class="card-img-top" src="/assets/images/<?= $picture->userID ?>/thumb__<?= $picture->image ?>" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title"><?= $picture->caption ?></h4>
						<?php if ( app::auth() && $picture->userID != app::authId()) {
						    $pRating = $page->user->ratings;
							$rated = isset($pRating[ $picture->ID ] );
							$rating = $rated ? $pRating[ $picture->ID ]->rating : null;

							?>
                            <form action="/api/rate" method="post">
								<?php if ( app::auth() ) { ?>
                                    <input type="hidden" name="pictureID" value="<?= $picture->ID ?>">
								<?php } ?>
                                <div class="btn-group " role="group" aria-label="Basic example">
                                    <button name="rating"
                                            value="0"
                                            type="submit"
										<?= $rated ? 'disabled' : '' ?>
                                            class="btn btn-<?= $rating == 0 && $rated ? 'primary' : 'default' ?>">
                                        <i class="fa fa-thumbs-down"></i> <?= $picture->dislikes ?>
                                    </button>
                                    <button name="rating"
                                            value="1"
                                            type="submit"
	                                    <?= $rated ? 'disabled' : '' ?>
                                            class="btn btn-<?= $rating == 1 && $rated ? 'primary' : 'default' ?>">
                                        <i class="fa fa-thumbs-up"></i> <?= $picture->likes ?>
                                    </button>
                                    <button name="rating"
                                            value="2"
                                            type="submit"
	                                    <?= $rated ? 'disabled' : '' ?>
                                            class="btn btn-<?= $rating == 2 && $rated ? 'primary' : 'default' ?>">
                                        <i class="fa fa-heart"></i> <?= $picture->favored ?>
                                    </button>
                                    <button name="rating"
                                            value="3"
                                            type="submit"
	                                    <?= $rated ? 'disabled' : '' ?>
                                            class="btn btn-<?= $rating == 3 && $rated ? 'primary' : 'default' ?>">
                                        <i class="fa fa-star"></i> <?= $picture->stared ?>
                                    </button>
                                </div>
                            </form>
							<?php
						} else {
							?>
                            <div class="btn-group " role="group" aria-label="Basic example">
                                <a class="disabled btn btn-outline-dark" href="#">
                                    <i class="fa fa-thumbs-down"></i> <?= $picture->dislikes ?>
                                </a>
                                <a class="disabled btn btn-outline-dark" href="#">
                                    <i class="fa fa-thumbs-up"></i> <?= $picture->likes ?>
                                </a>
                                <a class="disabled btn btn-outline-dark" href="#">
                                    <i class="fa fa-heart"></i> <?= $picture->favored ?>
                                </a>
                                <a class="disabled btn btn-outline-dark" href="#">
                                    <i class="fa fa-star"></i> <?= $picture->stared ?>
                                </a>
                            </div>
						<?php } ?>
                    </div>
                </div>
            </div>
		<?php } ?>
    </div>
</div>