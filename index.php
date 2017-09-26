<?php
require "vendor/autoload.php";

Connection::open();

// TODO: read and render templates and routes
app::layout();

Connection::close();