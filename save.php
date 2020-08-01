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
<h1>ADD</h1>
<form action="#" method="post" enctype="multipart/form-data">
  <input type="text" name="userName" placeholder="User Name" ><br>
  <input type="email" name="Email" placeholder="Your Email" ><br>
  <input type="text" name="location" placeholder="Your City"><br>
  <input type="text" name="skills" placeholder="Skills" ><br>
  <input type="password" name="password" placeholder="Password"><br>
  <input type="text" name="socialmedia" placeholder="Social Media" ><br>
  <input type="file" name="profile" id="profile"><br>
  <input type="submit" value="Add" name="submit">
</form>


<?php
try
{
      if(isset($_POST['submit'])){
		  
      $userName = filter_input(INPUT_POST, 'userName');
      $Email = filter_input(INPUT_POST, 'Email');
      $location = filter_input(INPUT_POST, 'location');
      $skills = filter_input(INPUT_POST, 'skills');
      $epass = filter_input(INPUT_POST, 'password');
      $socialmedia = filter_input(INPUT_POST, 'socialmedia');
	  if(!empty($_FILES['profile']['tmp_name']) 
		&& file_exists($_FILES['profile']['tmp_name'])) {
		$profile= addslashes(file_get_contents($_FILES['profile']['tmp_name']));
}

      if(empty($userName)){
        echo '<p>Enter a Valid username</p>';
      }

      else if(empty($Email) || !filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo '<p>Enter a Valid Email</p>';
      }

      else if(empty($location)){
        echo '<p>Enter a Valid Location</p>';
      }

      else if(empty($skills)){
        echo '<p> Enter Valid Skills</p>';
      }
      else if(empty($epass)){
        echo '<p> Enter Valid Password</p>';
      }
      else if(empty($socialmedia)){
        echo '<p> Enter Valid socialmedia</p>';
      }
	  else
	  {
      require('dbConnection.php');

        $sql = "INSERT INTO userinfo(username,email,location,skills,profileimage , socialmedia,password) values ('".$userName."','" .$Email."','". $location."','".$skills."','".$profile."','".$socialmedia."','".md5($epass)."')";
      
      if($conn->exec($sql))
	  {
	  echo "User Registered Successfully, You can login to have more access";
	  }
	  else
	  {
		  echo "Error Adding User to Database";
	  }
	  }
	  }
}catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
  }
?>
</center>
</body>
</html>