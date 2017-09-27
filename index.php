<?php session_start();
require "vendor/autoload.php";

$connection = new Connection();
app::$conn  = $connection->open();

// TODO: read and render templates and routes
app::init();

$connection->close();