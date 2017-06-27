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
    <link rel="stylesheet" type="text/css" href="dev2.css">
  </head>
  <body>
    <p>Recent Posts:
      <br>
      <?php
$sql="SELECT url FROM userpaste";
$result=mysqli_query($dbc,$sql);
while($row=mysqli_fetch_assoc($result)){
$id=$row["url"];
echo "<br><a href='show.php?id=$id'> $id </a><br>";
}
?>
    </p>
    <ul>
      <li>
        <a href="task3.php">Sign Out
        </a>
      </li>
    </ul>
    <?php 
$user=$_SESSION["uname"];
$query="INSERT INTO userpaste (url,user,paste) VALUES (?,?,?)";
$stmt=mysqli_prepare($dbc,$query);
$okay=0;
$textvalue="";
$texterr="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{if(empty($_POST["text"]))
$texterr="Not Valid";
else
{$textvalue=test_input($_POST["text"]);
$okay=1;
}
}
function test_input($data){
return $data;
}
$id=uniqid();
if($okay==1){
mysqli_stmt_bind_param($stmt,"sss",$id,$user,$textvalue);
mysqli_stmt_execute($stmt);
echo "Your id:".$id;
}
?>
    <div id="d1">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <textarea name="text" rows="30" cols="45" maxlength="800">
          <?php echo $textvalue; ?>
        </textarea>
        <input type="submit" value="<?php echo $user ?>">
        <?php
if($okay==1)
echo "<input type='submit' formaction='show.php?id=$id' value='see your snippet'>";
?>
        </div>
      </body>
    </html>
