<?php
require "vendor/autoload.php";

app::$db = Connection::open();

$p = new User();

app::layout();

Connection::close();