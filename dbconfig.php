<?php

$conn = mysqli_connect('localhost', 'root', 'jerusalem1991', 'php_crud_api');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}