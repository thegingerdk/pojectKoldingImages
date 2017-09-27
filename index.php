<?php
session_start();
require "vendor/autoload.php";

$connection = new Connection();
app::$conn  = $connection->open();

// TODO: read and render templates and routes
app::init();

if(count(app::$errors) > 0) {
	app::p(app::$errors);
}

$connection->close();