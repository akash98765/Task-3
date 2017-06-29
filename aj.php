<?php 
 session_start();
 
 $servername="localhost";
 $username="root";
 $password="Weiss-2sfj";
 $dbname="users";
 $dbc=@mysqli_connect($servername,$username,$password,$dbname);
 $stmt1="SELECT username FROM userlog";
 $verify=mysqli_query($dbc,$stmt1);
 $u=$_REQUEST['u'];
 while($row1=mysqli_fetch_assoc($verify)){
 if($u==$row1['username'])
 {echo "Username already taken";
  $_SESSION['taken']=0;
 
  break;
}
else
$_SESSION['taken']=1;
}
?>