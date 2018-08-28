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
	$user = new User();
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(isset($_POST['login']))
		{
			
			$user->setUsername($post['username']);
			$user->setPassword($post['password']);
			$username = $user->getUsername();
			$password = $user->getPassword();
			$login_check = $user->login();
			
			if($login_check == True)
			{
				header('location:dashboard.php');
				echo "Login";
			}
			else
			{
				echo "Invalid Username or Password";
			}

	}


	 ?>

	

	<div class="container">	
			<div class="row">
			<form method="POST">
			  
			  <div class="form-group">
			    <label for="exampleInputPassword1">Username</label>
			    <input type="text" class="form-control" name="username" id="exampleInputPassword1" placeholder="Username">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
			  </div>
			 
			  <button type="submit" class="btn btn-primary" name="login">Login</button>
			  <a href="index.php" class="btn btn-info">Register</a>
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