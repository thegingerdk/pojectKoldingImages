<?php

class Rating extends Models {

	/**
	 * Picture Primary Key
	 * Foreign Key
	 * @var  integer
	 */
	protected $pictureID;
	/**
	 * User Primary Key
	 * Foreign Key
	 * @var  integer
	 */
	protected $userID;
	/**
	 * 0: Dislike
	 * 1: Like
	 * 2: Favorite
	 * 3: Super Image
	 * @var  integer
	 */
	protected $rating;

	private $likes = 0;
	private $dislikes = 0;


	public static function getRatingsByImage( $pictureID ) {
		if ( $pictureID ) {
			$ratings = (new Rating())->findByQuery(
				"SELECT rating, COUNT(1) as count FROM ratings WHERE pictureID={$pictureID} GROUP BY rating"
			);

			$rtrn = [
				'likes'    => 0,
				'dislikes' => 0,
				'favored'  => 0,
				'stared'   => 0,
			];


			foreach ( $ratings as $type => $item ) {
				if ( $item['rating'] == 0 ) {
					$rtrn['dislikes'] = $item['count'];
				} else if ( $item['rating'] == 2 ) {
					$rtrn['favored'] = $item['count'];
				} else if ( $item['rating'] == 3 ) {
					$rtrn['stared'] = $item['count'];
				} else {
					$rtrn['likes'] += $item['count'];
				}
			}

			return $rtrn;
		} else {
			return false;
		}
	}

	public static function getRatingsByUser( $userID ) {

	}
}