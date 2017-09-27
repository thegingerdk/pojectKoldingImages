<?php

class Route {
	public $url;
	public $name;
	public $controller;
	public $function;

	private static function add( $type, $route, $args = [] ) {
		app::$routes[ $type ][ isset( $args['as'] ) ? $args['as'] : count( app::$routes ) - 1 ] = new Route( $route,
			$args );
	}

	public static function get( $route, $args = [] ) {
		self::add( 'get', $route, $args );
	}

	public static function post( $route, $args = [] ) {
		self::add( 'post', $route, $args );
	}

	public static function getApi( $route, $args = [] ) {
		self::addApi( 'get', $route, $args );
	}

	public static function postApi( $route, $args = [] ) {
		self::addApi( 'post', $route, $args );
	}

	public static function addApi( $type, $route, $args = [] ) {
		$args['as'] = isset( $args['as'] ) ? "api::{$args['as']}" : count( app::$routes ) - 1;

		self::add( $type, "/api{$route}", $args );
	}

	public function __construct( $route, $args = [] ) {

		$this->url = app::env( 'LOCAL_ROOT' ) . $route;

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