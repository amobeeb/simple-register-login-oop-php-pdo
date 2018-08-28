<?php 	
include('lib/user.class.php');
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<?php 	
	echo dirname( __FILE__ );
	$user = new User();
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(isset($_POST['submit']))
		{
			
			$user->setFullname($post['fullname']);
			$user->setUsername($post['username']);
			$user->setPassword($post['password']);
			$fullname = $user->getFullname();
			$username = $user->getUsername();
			$password = $user->getPassword();
			$user->prepareSql('INSERT INTO `user`(`fullname`, `username`, `password`) VALUES (?,?,?)');
			$query_user = $user->execute(array($fullname, $username, $password));
			if($query_user)
			{
				echo "Information Saved";
			}
			else
			{
				echo "Information Not Saved";
			}
		}


	 ?>

	

	<div class="container">	
			<div class="row">
			<form method="POST">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Fullname</label>
			    <input type="text" class="form-control" name="fullname" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Fullname">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Username</label>
			    <input type="text" class="form-control" name="username" id="exampleInputPassword1" placeholder="Username">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
			  </div>
			 
			  <button type="submit" class="btn btn-primary" name="submit">Register</button>
			  <a href="login.php" class="btn btn-info">Login</a>
				</form>	

			</div>

	</div>
	<div>	
			<table class="table">
			<?php 
			$user->prepareSql("SELECT * FROM `user`");
			$user->execute();

			 ?>	
				<tr>
					<th>Fullname</th>
					<th>Username</th>
					<th>Password</th>
					<th>Delete</th>
				</tr>
				<?php 
				$rows = $user->fetchData();
				
					foreach ($rows as $row) {
					
				 ?>
				<tr>
					<td><?php echo $row['fullname'] ?></td>
					<td><?php echo $row['username']; ?></td>
					<td><?php echo $row['password']; ?></td>
					<td><a href="deleteuser.php?id=<?php echo $row['user_id'] ?>">Delete</a></td>
				<?php } ?>
					



				</tr>
			</table>


	</div>
	


</body>
</html>