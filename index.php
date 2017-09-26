<?php
session_start();
require "vendor/autoload.php";

Conn::open();

// TODO: read and render templates and routes

require_once( 'Views/layout.php' );

Connection::close();