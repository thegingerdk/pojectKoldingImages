<div class="container">
    <div class="row">
        <div class="col">
            <div class="jumbotron">
                <h1><?= $page->title ?></h1>
            </div>
        </div>
    </div>
    <div class="row">
		<?php foreach ( $page->pictures as $picture ) {
			$rating   = null;
			$btnClass = "btn btn-default";
			if ( isset( $page->user->ratings[ $picture->ID ] ) ) {
				$btnClass = 'disabled btn btn-';
				$rating   = $page->user->ratings[ $picture->ID ]->rating;
			}
			?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="card">
                    <img class="card-img-top" src="/assets/images/<?= $picture->userID ?>/thumb__<?= $picture->image ?>" alt="Card image cap">
                    <div class="card-body">
                            <form action="/api/rate" method="post">
								<?php if ( app::auth() ) { ?>
                                    <input type="hidden" name="pictureID" value="<?= $picture->ID ?>">
								<?php } ?>
                                <div class="btn-group " role="group" aria-label="Basic example">
                                <button name="rating"
                                        value="0"
                                        type="submit"
                                        <?= !is_null($rating) ? 'disabled' : '' ?>
                                        class="<?= $btnClass ?><?= $rating == 0 ? 'primary' : 'default' ?>">
                                    <i class="fa fa-thumbs-down"></i> <?= $picture->dislikes ?>
                                </button>
                                <button name="rating"
                                        value="1"
                                        type="submit"
                                        <?= !is_null($rating) ? 'disabled' : '' ?>
                                        class="<?= $btnClass ?><?= $rating == 1 ? 'primary' : 'default' ?>">
                                    <i class="fa fa-thumbs-up"></i> <?= $picture->likes ?>
                                </button>
                                <button name="rating"
                                        value="2"
                                        type="submit"
                                        <?= !is_null($rating) ? 'disabled' : '' ?>
                                        class="<?= $btnClass ?><?= $rating == 2 ? 'primary' : 'default' ?>">
                                    <i class="fa fa-heart"></i> <?= $picture->favored ?>
                                </button>
                                <button name="rating"
                                        value="3"
                                        type="submit"
                                        <?= !is_null($rating) ? 'disabled' : '' ?>
                                        class="<?= $btnClass ?><?= $rating == 3 ? 'primary' : 'default' ?>">
                                    <i class="fa fa-star"></i> <?= $picture->stared ?>
                                </button>
                                </div>
                            </form>
                        <h4 class="card-title"><?= $picture->caption ?></h4>
                    </div>
                </div>
            </div>
		<?php } ?>
    </div>
</div>