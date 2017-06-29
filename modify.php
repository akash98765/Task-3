<?php 
 session_start();
 $id=$_SESSION["id"];
 $user=$_SESSION["uname"];
 $textvalue="";
 $servername="localhost";
 $username="root";
 $password="Weiss-2sfj";
 $dbname="users";
 $okay=0;
$ref="";
?>
<html>
<head>
<style>
.u1
{list-style-type:none;
 background-color:white;
 
}
ul
{list-style-type:none;
 background-color:#333333;
 padding:0px;
 overflow:hidden;
 margin:0px;
}
li
{float:left;
}
li a
{color:white;
 text-decoration:none;
 display:block;
 padding:20px;
}
li a:hover
{text-decoration:underline;
 background-color:#111111;
}
#d1
{
 
 height:480px;
 border:none;
 width:340px;
 
}
input[type=submit]{
border-radius:4px;
background-color:lightgrey;
}

</style>
</head>
<body>
<ul>
<li><a href="welcome.php">My Bin</a></li>
<li><a href="signout.php">Sign Out-<?php echo $user ?></a></li>
</ul>
<?php
$textvalue="";
$dbc=mysqli_connect($servername,$username,$password,$dbname);
$sql="SELECT url,paste FROM userin";
$result=mysqli_query($dbc,$sql);
if(empty($_POST["text"])){
while($row=mysqli_fetch_assoc($result)){
 if($row["url"]==$id){
 $textvalue=$row["paste"];
 $ref=$textvalue;
 break;
}
 
}
}
if(!empty($_POST["text"])){

$okay=1;
$ref=$_POST["text"];
}
if($okay==1){
$query="UPDATE userin SET paste=? WHERE url=?";
$stmt=mysqli_prepare($dbc,$query);
mysqli_stmt_bind_param($stmt,"ss",$ref,$id);
mysqli_execute($stmt);
}
?>
<div id="d1">
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<textarea name="text" rows="25" cols="40"><?php echo $ref; ?>
</textarea>
<input type="submit" value="<?php if($okay==0)echo 'edit'; else if($okay==1)
 echo 'edited';  ?>">
</div>
</body>
</html>
