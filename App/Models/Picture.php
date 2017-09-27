<?php


class Picture extends Models {

	/**
	 * Primary Key
	 * @var  integer */
	protected $ID;
	/**
	 * User Primary Key
	 * Foreign Key
	 * @var  integer */
	protected $userID;
	/**
	 * Image Caption
	 * @var  string */
	protected $caption;
	/**
	 * Path to image
	 * @var  string */
	protected $imageData;
	/**
	 * Blob backup of image
	 * @var  string */
	protected $imageBackup;
	/**
	 * Image MimeType
	 * @var  integer */
	protected $mime;
	/**
	 * Image Description / Story
	 * @var  string */
	protected $story;
	/**
	 * Keywords of image
	 * @var  string */
	protected $tags;


	private function upload (){
        $target_dir = "assets/images/{$this->userID}/";

        $file = $_FILES["fileToUpload"];

        if(!file_exists($target_dir)) mkdir($target_dir);

		$path_parts = pathinfo(basename($file["name"]));
		$this->imageData = app::randomStr(20) . "." . $path_parts['extension'];
		$filePath = "{$target_dir}{$this->imageData}";
        $uploadOk = 1;
// Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {


// Check file size
            if ($file["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($this->imageData)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                return false;
            } else {
                $image = $file["tmp_name"];
                $this->mime = $file['type'];

	            $this->imageBackup = addslashes(file_get_contents($image));
	            return move_uploaded_file($image, $filePath);
            }
        }
	}

	public function save() {
		$this->userID = app::uid();
		if($this->upload()){
			return parent::save();
		}
		return false;
	}
}