<?php 

	include("connect.php");
	include("functions.php");
	
	if(logged_in())
	{
	?>
		
		<a href="changepassword.php">Change Password</a> 
	<script language="javascript">
   window.location.href = "./index.html"
</script>
		<a href="logout.php" style="float:right; padding:10px; margin-right:40px; background-color:#eee; color:#333; text-decoration:none;">Logout</a>
	
	<?php 
		
	}
	else
	{
		header("location:index.html");
		exit();
	}

?>
