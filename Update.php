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
  <li><a href="save.php">Add</a></li>
</ul>
<center>
<h1>Update</h1>
<?php 

try
{
	  $userid = $_GET['userid'];
      require('dbConnection.php');

	  if(isset($_POST['submit']))
	  {
      $userName = filter_input(INPUT_POST, 'userName');
      $Email = filter_input(INPUT_POST, 'Email');
      $location = filter_input(INPUT_POST, 'location');
      $skills = filter_input(INPUT_POST, 'skills');
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
	  else
	  {
      require('dbConnection.php');
       $sql = "Update userinfo set username='".$userName."', email='".$Email."', location='".$location."', skills='".$skills."' Where userid = ".$userid;
	  if($conn->exec($sql))
	  {
	  echo "Update Successful";
	  echo "<hr/><a href='index.php'>Go Home</a>";
	  }
	  else
	  {
		  echo "Error Updating data to Database";
	  echo "<hr/><a href='index.php'>Go Home</a>";
	  }
	  }
	  }
	  else
	  {

      $sql = "Select * from userinfo where userid = ".$userid;
      
	  
		$cmd = $conn->prepare($sql);
		$cmd->execute();
		$users = $cmd->fetchAll();
		
		foreach( $users as $user)
		{
		?>
			
			
<form action="#" method="post">
  <input type="text" name="userName" placeholder="User Name" value="<?php echo $user['username'] ?>"><br>
  <input type="text" name="Email" placeholder="Your Email" value="<?php echo $user['email'] ?>"><br>
  <input type="text" name="location" placeholder="Your Location" value="<?php echo $user['location'] ?>"><br>
  <input type="text" name="skills" placeholder="Skills" value="<?php echo $user['skills'] ?>"><br>
  <input type="hidden" name="userid" value="<?php echo $user['userid'] ?>"><br>
  <input type="submit" value="Update" name="submit">
</form>
<?php
		}
	  }
}catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
?>
</center>
</body>
</html>