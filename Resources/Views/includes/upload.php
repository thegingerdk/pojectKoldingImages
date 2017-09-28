    <h5>Upload new image</h5>
    <hr>
    <form action="/api/upload" method="post" enctype="multipart/form-data">

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
        <button type="submit" class="btn btn-block btn-outline-success">Save changes</button>
    </form>

