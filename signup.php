<html>
<head>
<link rel="stylesheet" type="text/css" href="dev.css">
</head>
<body style="background-color:white;">
<?php 
   $servername="localhost";
 $username="root";
 $password="Weiss-2sfj";
 $dbname="users";
 $dbc=@mysqli_connect($servername,$username,$password,$dbname);
 
 $query="INSERT INTO userlog (username,password,email) VALUES (?,?,?)";
 $stmt=mysqli_prepare($dbc,$query);

  $okay1=$okay2=$okay3=0;
  $c=0;
 $goto="task3.php";
 $uname=$email=$pass="";
 $unameerr=$emailerr=$passerr="";
 if($_SERVER["REQUEST_METHOD"]=="POST"){
 if(empty($_POST["uname"])){--$c;
 $unameerr="No name inserted";
$okay1=0;}
 else{$okay1=1;++$c;
 $uname=test_input($_POST["uname"]);
 if(!preg_match("/^[a-zA-Z ]*$/",$uname)){$okay1=0;--$c;
 $unameerr="Name only in letters and whitespaces";
}
}
if(empty($_POST["email"])){$okay2=0;--$c;
 $emailerr="No email entered";
}else
{$email=test_input($_POST["email"]);$okay2=1;++$c;
 if(!filter_var($email,FILTER_VALIDATE_EMAIL)){$okay2=0;--$c;
  $emailerr="Invalid email-id";
 }
}
if(empty($_POST["pass"])){$okay3=0;--$c;
$passerr="No password entered";
}
else{$okay3=1;
$pass=test_input($_POST["pass"]);++$c;
}
}
function test_input($data){
$data=trim($data);
$data=stripslashes($data);
$data=htmlspecialchars($data);
return $data;
}
if(($okay1==1)&&($okay2==1)&&($okay3==1)){
mysqli_stmt_bind_param($stmt,"sss",$uname,$pass,$email);
 mysqli_stmt_execute($stmt);

}
?>
<p><span class="s1">* Required Fields</span></p>

<form method="post" action="<?php if(($okay1==0)||($okay2==0)||($okay3==0))echo htmlspecialchars($_SERVER['PHP_SELF']); else
 echo $goto; ?>">
<fieldset>
<legend> Personal Info. </legend>
<p>
<label for="a">
UserName:</label><input type="text" name="uname" value="<?php echo $uname; ?>" placeholder="your username..."><span class="s1">* <?php echo $unameerr; ?></span><br>
</p>
<p>
<label for="b">
Email-Address:</label><input type="text" name="email" value="<?php echo $email; ?>" placeholder="your email..."><span class="s1">* <?php echo $emailerr; ?></span><br>
</p>
<p>
<label for="c">
Password:</label><input type="password" name="pass" value="<?php echo $pass; ?>" placeholder="password...."><span class="s1">* <?php echo $passerr; ?></span></br>
</p>
<input type="submit" value="<?php if($c<3)
 echo 'Create My Account'; else
  echo 'Click Again!'; ?>">
</fieldset>
</form>

</body>
</html>
