<?php
require "vendor/autoload.php";

$connection = new Connection();
app::$conn  = $connection->open();

// TODO: read and render templates and routes

$user = (new User())->find(3);


echo $user->getFirstname();


app::init();

$connection->close();