<?php
namespace App;

class Routes {
	public $url;

	public function __construct( $args = [] ) {
		if (! empty($args['url'])) $this->url = $args['url'];
	}
}