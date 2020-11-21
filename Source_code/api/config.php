<?php

$conn = mysqli_connect("database_name", "root", "password");
mysqli_select_db($conn, 'digitech');
mysqli_set_charset($conn, 'utf8');