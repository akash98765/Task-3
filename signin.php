<?php
 session_start();
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="dev1.css">
</head>
<body>
<?php 
$okay=0;
$c=-1;
$goto="welcome.php";
$pass=$uname="";
$err="";
$username="root";
$servername="localhost";
$password="Weiss-2sfj";
$dbname="users";
$dbc=@mysqli_connect($servername,$username,$password,$dbname);
$sql="SELECT username,password FROM userlog";
$result=mysqli_query($dbc,$sql);
if($_SERVER["REQUEST_METHOD"]=="POST"){
 if(empty($_POST["uname"])||empty($_POST["pass"])){--$c;
 $err="Invalid credentials";
}
else{$c=0;
$uname=$_POST["uname"];
$pass=$_POST["pass"];
while($row=mysqli_fetch_assoc($result)){
if(($row["username"]==$uname) && ($row["password"]==$pass))
{$okay=1;
 break;
}
}
}

}

if($okay==0){
$err="Invalid credentials";
--$c;
}
$_SESSION["uname"]=$uname;
$_SESSION["pass"]=$pass;
?>
<span class="s1"><?php echo $err; ?></span>
<form method="post" action="<?php if($okay==0)echo htmlspecialchars($_SERVER['PHP_SELF']); else
 echo $goto; ?>">
<fieldset>
<legend>Login</legend>
<p>
<label for="a">
UserName:</label><input type="text" name="uname" value="<?php echo $uname; ?>"><br>
</p>
<p>
<label for="b">
Password:</label><input type="password" name="pass" value="<?php echo $pass; ?>"><br>
</p>
<input type="submit" value="<?php if($c<0)
 echo 'okay'; else if($c==0)
 echo 'Click Again'; ?>">
</fieldset>

</form>
</body>
</html>