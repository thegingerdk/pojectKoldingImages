<?php

class Route {
	public $url;
	public $name;
	public $controller;
	public $function;

	public static function get( $route, $args = [] ) {
		self::add('get', $route, $args);
	}

	public static function post( $route, $args = [] ) {
		self::add('post', $route, $args);
	}

	private static function add ($type, $route, $args = []){
		app::$routes[$type][ isset( $args['as'] ) ? $args['as'] : count( app::$routes ) - 1 ] = new Route( $route, $args );
	}

	public static function addApi( $route, $args = [] ) {
		$args['as'] = isset( $args['as'] ) ? "api::{$args['as']}" : count( app::$routes ) - 1;

		app::$routes['api'][ $args['as'] ] = new Route( "/api{$route}", $args );
	}

	public function __construct( $route, $args = [] ) {

		$this->url = $route;

		if ( ! empty( $args['as'] ) ) {
			$this->name = $args['as'];
		}

		if ( ! empty( $args['uses'] ) ) {
			$c = explode( '@', $args['uses'] );

			$this->controller = $c[0];
			$this->function   = $c[1];
		}
	}
}