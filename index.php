<?php
require "vendor/autoload.php";

Connection::open();

$t = new User();

$t->save();

// TODO: read and render templates and routes
app::layout();

Connection::close();