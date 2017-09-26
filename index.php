<?php
require "vendor/autoload.php";

$connection = new Connection();
app::$conn  = $connection->open();

$t = new User();

$result = $t->save([
	'email' => 'mike@theginger.dk',
	'firstname' => 'Mike',
	'lastname' => 'Fosmark',
	'password' => 'test',
	'nickname' => 'thegingerdk',
]);

app::p($result);

// TODO: read and render templates and routes
app::init();

$connection->close();