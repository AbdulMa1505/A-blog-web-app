<?php
$server='localhost';
$dbname='admin';
$username='root';
$password='';
$conn =new PDO("mysql:host=$server;dbname=$dbname;",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
if(!$conn){
echo "connection err";
}

?>