<?php 
session_start();
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="main.css">
  </head>
  <body>
    <ul>
      <li>
        <a href="welcome.php">My Bin
        </a>
      </li>
      <li>
        <a href="task3.php">Sign Out-
          <?php echo $_SESSION["uname"] ?>
        </a>
      </li>
    </ul>
    <?php
$id=$_GET["id"];
$textvalue="";
$servername="localhost";
$username="root";
$password="Weiss-2sfj";
$dbname="users";
$dbc=@mysqli_connect($servername,$username,$password,$dbname);
$stmt="SELECT url,paste FROM userpaste";
$result=mysqli_query($dbc,$stmt);
while($row=mysqli_fetch_assoc($result)){if($id==$row["url"]){
$textvalue=$row["paste"];
break;
}
}
?>
    <textarea rows="25" cols="30" maxlength="3000">
      <?php echo $textvalue; ?>
    </textarea>
  </body>
</html>
