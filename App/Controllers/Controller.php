<?php
/**
 * Created by PhpStorm.
 * User: thegingerdk
 * Date: 26/09/2017
 * Time: 12.41
 */

class Controller {
	protected $route;

	public function __construct($function) {
		$this->$function();
	}
}