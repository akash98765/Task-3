<?php
session_start();
$_SESSION['error1']=1;
$taken=1;
$servername="localhost";
$username="root";
$password="Weiss-2sfj";
$dbname="users";
$dbc=@mysqli_connect($servername,$username,$password,$dbname);
/*$stmt1="SELECT username FROM userlog";
$verify=mysqli_query($dbc,$stmt1);
$u=$_REQUEST['u'];
while($row1=mysqli_fetch_assoc($verify)){
if($u==$row1['username'])
{ $taken=0;
echo "Username already taken";
$_SESSION['error1']=0;
break;
}
}
echo $taken;
*/
$query="INSERT INTO userlog (username,password,email) VALUES (?,?,?)";
$stmt=mysqli_prepare($dbc,$query);
function test_input($data){
$data=trim($data);
$data=stripslashes($data);
$data=htmlspecialchars($data);
return $data;
}
if(isset($_POST['submit'])&& !empty($_POST['submit'])){
if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
$secret='6Lf2RScUAAAAAF41kNp5W57Rwm5wBdQwW-wjy1n8';
$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
$responseData = json_decode($verifyResponse);
if($responseData->success){
}
else
$_SESSION['error1']=0;
}
$uname=test_input($_POST["uname"]);
if(!preg_match("/^[a-zA-Z]*$/",$uname))
{$_SESSION['error1']=0;
}
$email=test_input($_POST['email']);
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
$_SESSION['error1']=0;
}
$pass=$_POST['pass'];
}
if($_SESSION['error1']==1 && $_SESSION['taken']==1){
mysqli_stmt_bind_param($stmt,"sss",$uname,$pass,$email);
mysqli_execute($stmt);
header("Refresh:0;url=task3.php");
}
else
{
header("Refresh:0;url=signup.php");
}
?>
