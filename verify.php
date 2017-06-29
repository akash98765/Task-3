<?php
session_start();
$uname=$pass=$cap="";
$username="root";
$servername="localhost";
$password="Weiss-2sfj";
$dbname="users";
$dbc=@mysqli_connect($servername,$username,$password,$dbname);
$sql="SELECT username,password FROM userlog";
$result=mysqli_query($dbc,$sql);
if(isset($_POST['submit'])&& !empty($_POST['submit'])){
$uname=!empty($_POST['uname'])?$_POST['uname']:'';
$pass=!empty($_POST['pass'])?$_POST['pass']:'';
$cap=!empty($_POST['cap'])?$_POST['cap']:'';
}
if($cap!=$_SESSION['secure']){
$_SESSION['error1']=0;
header("Refresh:0; url=signin.php");
}
else
$_SESSION['error1']=1;
while($row=mysqli_fetch_assoc($result)){
if($uname==$row['username'] && $pass==$row['password'])
{$_SESSION['uname']=$uname;
$_SESSION['pass']=$pass;
$_SESSION['error']=1;
break;
}
}
if($_SESSION['error']==1 && $_SESSION['error1']==1)
header("Refresh:0;url=welcome.php");
else
header("Refresh:0;url=signin.php");
?>
