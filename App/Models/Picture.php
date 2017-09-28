<?php


class Picture extends Models {

	protected $hidden = [ 'imageBackup', 'ratings', 'likes', 'dislikes', 'favored', 'stared' ];

	/**
	 * Primary Key
	 * @var  integer
	 */
	protected $ID;
	/**
	 * User Primary Key
	 * Foreign Key
	 * @var  integer
	 */
	protected $userID;
	/**
	 * Image Caption
	 * @var  string
	 */
	protected $caption;
	/**
	 * Path to image
	 * @var  string
	 */
	protected $image;
	/**
	 * Blob backup of image
	 * @var  string
	 */
	protected $imageBackup;
	/**
	 * Image MimeType
	 * @var  integer
	 */
	protected $mime;
	/**
	 * Image Description / Story
	 * @var  string
	 */
	protected $story;
	/**
	 * Keywords of image
	 * @var  string
	 */
	protected $tags;

	protected $likes = 0;
	protected $dislikes = 0;
	protected $favored = 0;
	protected $stared = 0;

	private $ratings = [];


	private function upload() {
		$target_dir = "assets/images/{$this->userID}/";

		$file = $_FILES["file"];

		if ( ! file_exists( $target_dir ) ) {
			mkdir( $target_dir );
		}

		$path_parts  = pathinfo( basename( $file["name"] ) );
		$this->image = app::randomStr( 20 ) . "." . $path_parts['extension'];
		$filePath    = "{$target_dir}{$this->image}";

		if ( $file["size"] > 5000000 ) {
			app::$errors['image'] = "Sorry, your file is too large.";

			return false;
		}

		// Check if file already exists
		if ( file_exists( $this->image ) ) {
			app::$errors['image'] = "Sorry, file already exists.";

			return false;
		}

		// Check if $uploadOk is set to 0 by an error
		$image      = $file["tmp_name"];
		$this->mime = $file['type'];

		$this->imageBackup = addslashes( file_get_contents( $image ) );

		return move_uploaded_file( $image, $filePath );
	}

	public function save() {
		$this->userID = app::authId();
		if ( $this->upload() ) {
			$result = parent::save();

			unset( $this->imageBackup );

			$this->createThumbnail();

			return $result;
		}

		return false;
	}

	private function createThumbnail() {
		$path = "assets/images/{$this->userID}/";

		app::resizeImage( 400, "{$path}small__{$this->image}", "{$path}{$this->image}" );
		app::resizeImage( 600, "{$path}medium__{$this->image}", "{$path}{$this->image}" );

		$im = new ImageManipulator( "{$path}small__{$this->image}" );

		$centreX = round( $im->getWidth() / 2 );
		$centreY = round( $im->getHeight() / 2 );

		$x1 = $centreX - 200;
		$y1 = $centreY - 150;

		$x2 = $centreX + 200;
		$y2 = $centreY + 150;

		$im->crop( $x1, $y1, $x2, $y2 ); // takes care of out of boundary conditions automatically
		$im->save( "{$path}thumb__{$this->image}" );
	}

	public function __construct( array $args = [] ) {
		parent::__construct( $args );

		if ( ! empty( $this->image ) ) {

			$ratings = Rating::getRatingsByImage( $this->ID );

			$this->likes    = $ratings['likes'];
			$this->dislikes = $ratings['dislikes'];
			$this->favored  = $ratings['favored'];
			$this->stared   = $ratings['stared'];
		}
	}

	public static function delete( $id = 0, $where = 'ID' ) {

		Rating::delete( $id, 'pictureID' );

		return parent::delete( $id );
	}

	public static function addRating( $value, $obj ) {
		if ( $value == 0 ) {
			$obj->dislikes ++;
		} else if ( $value == 2 ) {
			$obj->favored ++;
		} else if ( $value == 3 ) {
			$obj->stared ++;
		} else {
			$obj->likes ++;
		}

		return $obj;
	}
}