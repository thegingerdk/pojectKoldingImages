

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Upload new image</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
            <form action="/api/upload" method="post" enctype="multipart/form-data">
			<div class="modal-body">

					<div class="form-group">
						<input type="file" class="form-control-file" name="file" id="file" style="text-align:center;padding:100px 25px;border:2px solid #4a4a4a;width:100%;">
					</div>

					<div class="form-group">
						<label for="caption">Image title</label>
						<input type="text" class="form-control" name="caption" id="caption">
					</div>

					<div class="form-group">
						<label for="tags">Tags</label>
						<input type="text" class="form-control" name="tags" id="tags" placeholder="#awesome #nice #totallymindblowingpicture">
					</div>

					<div class="form-group">
						<label for="story">Story</label>
						<textarea class="form-control" name="story" id="story" rows="3"></textarea>
					</div>
			</div>
			<div class="modal-footer">
				<a class="btn btn-default" href="#" data-dismiss="modal">Close</a>
				<button type="submit" class="btn btn-outline-success">Save changes</button>
			</div>
            </form>
		</div>
	</div>
</div>