<?php
require "vendor/autoload.php";

app::$db = Connection::open();

$t = new User();

$t->save();

// TODO: read and render templates and routes
app::layout();
Connection::close();