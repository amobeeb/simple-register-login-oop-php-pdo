<?php 
include('lib/user.class.php');
// session_start();
$user = new User();
// echo $_SESSION['user_id'];
$user_id =   User::loginSession_id();
$user->prepareSql("SELECT * FROM `user` WHERE `user_id`=?");
$user->execute([$user_id]);
$user = $user->fetchData();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
	<h1>Welcome <?php echo $user[0]['username'] ?></h1>

</body>
</html>