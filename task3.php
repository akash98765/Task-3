<?php
session_start();
$go="task3.php";
$servername="localhost";
$username="root";
$password="Weiss-2sfj";
$dbname="users";
$dbc=@mysqli_connect($servername,$username,$password,$dbname);
$id=0;
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="dev.css">
  </head>
  <body>
    <ul>
      <li>
        <a href="signin.php">Sign In
        </a>
      </li>
      <li>
        <a href="signup.php">Sign Up
        </a>
      </li>
      <li>
        <a href="about.php">About
        </a>
      </li>
    </ul>
    <div id="d1">
      <h2>Welcome!
      </h2>
      <!--<p id="p1"><a href="signup.php">Sign up</a> to start using</p>
-->
    </div>
    <h4>Recent Posts:
      <br>
      <?php
$sql="SELECT url FROM userpaste";
$result=mysqli_query($dbc,$sql);
while($row=mysqli_fetch_assoc($result)){
$id=$row["url"];
echo "<br><a href='show1.php?id=$id'> $id </a><br>";
}
?>
    </h4>
  </body>
  <?php
session_unset();
session_destroy();
?>
</html>
