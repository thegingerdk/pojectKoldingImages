<?php
require "vendor/autoload.php";

$connection = new Connection();
app::$conn  = $connection->open();

$user = new User();

$user->save([
    "firstname" => "Peter",
    "lastname" => "M"
    ], 1);



// TODO: read and render templates and routes
app::init();

$connection->close();