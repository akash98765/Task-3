<?php
session_start();
$_SESSION['error']=0;
$_SESSION['error1']=1;
$_SESSION['taken']=1;
$go="task3.php";
$servername="localhost";
$username="root";
$password="Weiss-2sfj";
$dbname="users";
$dbc=@mysqli_connect($servername,$username,$password,$dbname);
$id=0;
$sql="DELETE FROM userin WHERE expirydate<NOW()";
mysqli_query($dbc,$sql);
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
      <br>
      <span>
        <a href="signup.php">Sign Up
        </a> to start using
      </span>
      <!--<p id="p1"><a href="signup.php">Sign up</a> to start using</p>
-->
    </div>
    <h4>Recent Posts:
      <br>
      <?php
$name="anonymous";
$sql="SELECT url,user,type,visible FROM userin";
$result=mysqli_query($dbc,$sql);
while($row=mysqli_fetch_assoc($result)){
if($row["visible"]!="Private"){
if($row["type"]=="be known")
{$name=$row["user"];
} 
else
$name="anonymous";
$id=$row["url"];
echo "<br><a href='show1.php?id=$id'> $id-$name </a><br>";
}
}
?>
    </h4>
  </body>
</html>
