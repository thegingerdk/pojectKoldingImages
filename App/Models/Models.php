<?php
/**
 * Created by PhpStorm.
 * User: thegingerdk
 * Date: 26/09/2017
 * Time: 13.19
 */

class Models extends DataBase {
	public function __construct($args = []) {

		foreach ( get_object_vars( $this ) as $key => $val ) {
			if(isset($args[$key])) $this->$key = $args[$key];
		}
	}

}