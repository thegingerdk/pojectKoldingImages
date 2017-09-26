<?php
require "vendor/autoload.php";

$connection = new Connection();
app::$db = $connection->open();

$t = new User();

// TODO: read and render templates and routes
app::layout();
$connection->close();