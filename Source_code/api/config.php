<?php

$conn = mysqli_connect("localhost", "root", "");
mysqli_select_db($conn, 'digitech');
mysqli_set_charset($conn, 'utf8');