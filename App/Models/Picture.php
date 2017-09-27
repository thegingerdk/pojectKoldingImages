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
        $target_dir = "assets/images/";

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {


// Check file size
            if ($_FILES["fileToUpload"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
            } else {
                $image = $_FILES["fileToUpload"]["tmp_name"];
                if (move_uploaded_file($image, $target_file)) {
                    $this->imageBackup=addslashes(file_get_contents($image));


                }
            }
        }
	}

	public function save() {
		$this->upload();
		$this->save();
	}
}