<?php session_start();?>
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
	  <?php
  }
  else
  {
	  
  ?>
  <li><a href="login.php">Login</a></li>
  <li><a href="save.php">Register</a></li>
</ul>
  <?php } ?>
	<center>
		<table id="data">
		  <tr>
    <th>ID</th>
    <th>Username</th>
    <th>Email</th>
    <th>Location</th>
    <th>Skills</th>
    <th>Social Media</th>
    <th>Image</th>
	<?php 
	if(isset($_SESSION['user'])) 
	{
	?>
    <th>Update</th>
    <th>Delete</th>
  <?php }?>
  </tr>
  
<?php 
    require('dbConnection.php');

    $sql = "SELECT * FROM userinfo";

    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $stuffs = $cmd->fetchAll();

    foreach($stuffs as $stuff){
		
		?>
       <tr>
	   <td><?php echo $stuff['userid']; ?></td>
	   <td><?php echo $stuff['username']; ?></td>
       <td><?php echo $stuff['email']; ?></td>
       <td><?php echo $stuff['location']; ?></td>
       <td><?php echo $stuff['skills']; ?></td>
       <td><?php echo $stuff['socialmedia']; ?></td>
       <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $stuff['profileimage'] ).'" height="100px" width="200px" alt="No Image"/>'; ?></td>
	   	<?php 
	if(isset($_SESSION['user'])) 
	{
	?>
       <td><a href="update.php?userid='<?php echo $stuff['userid'] ?>'">Edit</a></td>
       <td><a href="delete.php?userid='<?php echo $stuff['userid'] ?>'">Delete</a></td>
	     <?php }?>
       </tr>
	   <?php
    }
?>
</table>
   </center>
