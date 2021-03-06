<?php

	include("connect.php");
	include("functions.php");
	
	if(logged_in())
	{
		header("location:profile.php");
		exit();
	}
	
	$error = "";

	if(isset($_POST['submit']))
	{
		$firstName = mysql_real_escape_string($_POST['fname']);
		$lastName = mysql_real_escape_string($_POST['lname']);
	    $email = mysql_real_escape_string($_POST['email']);
	    $password = $_POST['password'];
	    $passwordConfirm = $_POST['passwordConfirm'];		
		$conditions = isset($_POST['conditions']);

		
		
		if(strlen($firstName) < 3)
		{
			$error = "First name is too short";
		}
		
		else if(strlen($lastName) < 3)
		{
			$error = "Last name is too short";
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$error = "Please enter valid email address";
		}
		else if(email_exists($email, $con))
		{
			$error = "Someone is already registered with this email";
		}
		else if(strlen($password) < 8)
		{
			$error = "Password must be greater than 8 characters";
		}
		else if($password !== $passwordConfirm)
		{
			$error = "Password does not match";
		}			
		else if(!$conditions)
		{
			$error = "You must be agree with the terms and conditions";
		}
		else
		{	
				$password = md5($password);
					$insertQuery = "INSERT INTO users(firstName, lastName, email, password) VALUES ('$firstName','$lastName','$email','$password')";
					if(mysqli_query($con, $insertQuery))
					{
							$error = "You are successfully registered";
						}
						else
						{
							$error = "Image is not uploaded";
						}
		}
							
	}

?>



<!doctype html>

<html>
	
	<head>
		
	<title>Registration Page</title>
	<link rel="stylesheet" href="css/logstyles.css"  />
	
	</head>
	
	
	<body>
		
		<div id="error" style=" <?php  if($error !=""){ ?>  display:block; <?php } ?> "><?php echo $error; ?></div>
		
		<div id="wrapper">
			
			<div id="menu">
				<a href="sign.php">Sign Up</a>
				<a href="login.php">Login</a>
			</div>
			
			<div id="formDiv">
				
				<form method="POST" action="sign.php" enctype="multipart/form-data">
				
				<label>First Name:</label><br/>
				<input type="text" name="fname" class="inputFields" required/><br/><br/>
				
				<label>Last Name:</label><br/>
				<input type="text" name="lname"  class="inputFields" required/><br/><br/>
				
				<label>Email:</label><br/>
				<input type="text" name="email"  class="inputFields" required/><br/><br/>
				
				<label>Password:</label><br/>
				<input type="password" name="password" class="inputFields"  required/><br/><br/>
				
				<label>Re-enter Password:</label><br/>
				<input type="password" name="passwordConfirm"  class="inputFields" required/><br/><br/>
				
			
				<input type="checkbox" name="conditions" />
				<label>I am agree with terms and conditions</label><br/><br/>
				
				<input type="submit"  class="theButtons"  name="submit" />

				
				
				</form>
			
			</div>
		
		</div>
		
	</body>

</html>
