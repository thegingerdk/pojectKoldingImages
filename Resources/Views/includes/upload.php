<div class="upload-form">
    <h5>Upload new image</h5>
    <hr>
    <form action="/api/upload" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <input type="file" class="form-control-file" name="file" id="file">
        </div>

        <div class="form-group">
            <label for="caption">Image title</label>
            <input type="text" class="form-control" placeholder="Image caption" name="caption" id="caption">
        </div>

        <div class="form-group">
            <label for="tags">Tags</label>
            <input type="text" class="form-control" name="tags" id="tags" placeholder="Tags: #awesome #nice #totallymindblowingpicture">
        </div>

        <div class="form-group">
            <label for="story">Story</label>
            <textarea class="form-control" placeholder="Story" name="story" id="story" rows="1"></textarea>
        </div>
        <button type="submit" class="btn btn-block btn-outline-success">Save changes</button>
    </form>

</div>