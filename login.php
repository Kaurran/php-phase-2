<?php
session_start();
?>
<html>
<head>
<title>
Phase One
</title>
<style>
#data {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#data td, #data th {
  border: 1px solid #ddd;
  padding: 8px;
}

#data tr:nth-child(even){background-color: #f2f2f2;}

#data tr:hover {background-color: #ddd;}

#data th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}


ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}
</style>
</head>
<body>
<ul>
  <li><a href="index.php">Home</a></li>
  <?php 
  if(isset($_SESSION['user'])) 
  {
	  ?>
  <li><a href="logout.php">Logout : <?php echo $_SESSION['user']?></a></li></ul>
	  <center><h1>Not Available</h1></center>
	  <?php
  }
  else
  {
	  
  ?>
  <li><a href="login.php">Login</a></li>
  <li><a href="save.php">Register</a></li>
</ul>
<center>
<h1>LOGIN</h1>
<form action="#" method="post">
  <input type="email" name="Email" placeholder="Your Email" ><br>
  <input type="password" name="password" placeholder="Your Password"><br>
  <input type="submit" value="Login" name="submit">
</form>


<?php
try
{
      if(isset($_POST['submit'])){
		  
      $Email = filter_input(INPUT_POST, 'Email');
      $epass = filter_input(INPUT_POST, 'password');

      if(empty($Email) || !filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo '<p>Enter a Valid Email</p>';
      }

      else if(empty($epass)){
        echo '<p> Enter Valid Password</p>';
      }
	  else
	  {
		 $epass = md5($epass);
		  
		require('dbConnection.php');

        $sql = "Select * From userinfo where email = '$Email' and password = '$epass'";
		$cmd = $conn->prepare($sql);
		$cmd->execute();
		$row = $cmd->fetch();
		
      if($row['userid'] > 0 )
	  {
	  echo "You Are Logged in successfully";
	  $_SESSION['user'] = $row['username'];
	  header("Location:index.php");
	  }
	  else
	  {
		  echo "Incorrect Login Details";
	  }
	  }
	  }
}
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
  }
?>
</center>
</body>
</html>