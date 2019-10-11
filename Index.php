<?php
include('Connection.php');
session_start();
$error="";

  if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myname = mysqli_real_escape_string($con,$_POST['Name']);
      $mysurname = mysqli_real_escape_string($con,$_POST['Surname']);
      $mypassword = $_POST['Password']; 
      
      $sql = "SELECT * FROM users WHERE Name = '$myname' AND Surname = '$mysurname' AND Password = '$mypassword'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['login_user'] = $myname;
         
         header("location: Dashboard.php");
      }else {
        echo "<script>alert('Name,Surname or Password is incorrect')</script>";
      }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
</head>
<body>
<h1>Login</h1>
<center><form action="" method="post">
	<table>
		</th>
		<tr>
			<td><label>Name :</label></td>
			<td><input type="text" name="Name" required="" placeholder="Name" style="width:60%; color:#524719;"></td>
		</tr>
		<tr>
			<td><label>Surname :</label></td>
			<td><input type="text" name="Surname" required="" placeholder="Surname" style="width:60%; color:#524719;"></td>
		</tr>
		<tr>
			<td><label>PASSWORD :</label></td>
			<td><input type="Password" name="Password" required="" placeholder="Password" style="width:60%; color:#524719;"></td>
		</tr>
	</table>
	<tr>
	<label style="text-align:center; margin-left:-1px;"><a href="reset.php">Reset Password here</a></label>	
	</tr>
	<br>
	<tr>
	<input style="color: #524719;" type="submit" name="Login" value="Login">
	</tr>
	
</form></center>
</body>
</html>