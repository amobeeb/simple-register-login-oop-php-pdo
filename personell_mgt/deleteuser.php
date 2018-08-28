<?php 
include('lib/user.class.php');
$id = $_GET['id'];

$user = new User();
$user->prepareSql("DELETE FROM `user` WHERE `user_id`=$id");
$user->execute();
header('location:index.php');


 ?>