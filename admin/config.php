<?php
$conn = mysqli_connect("localhost","root","","web-crunchybite");

if (!$conn){
    die ("gagal terhubung" . mysqli_connect_error());
} 