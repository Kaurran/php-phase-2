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
<h1>Delete</h1>
<?php 

try
{
	  $userid = $_GET['userid'];
      require('dbConnection.php');

	  if(isset($_POST['submit']))
	  {
      $sql = "Delete from userinfo Where userid = ".$userid;
	  if($conn->exec($sql))
	  {
	  echo "Successfully Deleted Record";
	  echo "<hr/><a href='index.php'>Go Home</a>";
	  }
	  else
	  {
		  echo "Error Deleting data to Database";
	  echo "<hr/><a href='index.php'>Go Home</a>";
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
			echo "<br/>Username : ".$user['username'];
			echo "<br/>Email : ".$user['email'];
			echo "<br/>Location : ".$user['location'];
			echo "<br/>Skills : ".$user['skills'];
			echo "<hr/>"
		?>
			
<form action="#" method="post">
	<input type="hidden" value="<?php echo $userid; ?>" name="userid">
  Delete ? <input type="submit" value="Yes" name="submit">
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