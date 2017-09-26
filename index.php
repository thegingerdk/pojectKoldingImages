<?php
require "vendor/autoload.php";

$connection = new Connection();
app::$conn  = $connection->open();

$t = new User();

// TODO: read and render templates and routes
app::init();

$connection->close();