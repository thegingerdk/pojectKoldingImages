<div class="container">
    <div class="row">
		<?php if ( isset( $page->delete ) && $page->delete == true ) { ?>
        <div class="col-4">
			<?php require_once "includes/upload.php"; ?>

        </div>
        <div class="col">
			<?php } else { ?>
            <div class="col">
				<?php } ?>

                <home uid="<?= app::authId() ?>" authenticated="<?= app::auth() ?>" remove="<?= isset( $page->delete ) ? true : false ?>"></home>
            </div>
        </div>
    </div>