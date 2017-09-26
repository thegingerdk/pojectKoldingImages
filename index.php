<?php
require "vendor/autoload.php";

app::$db = Connection::open();

$t = new User();

// TODO: read and render templates and routes
app::layout();
Connection::close();