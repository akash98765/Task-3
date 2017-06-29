<?php
session_start();
$go="task3.php";
$servername="localhost";
$username="root";
$password="Weiss-2sfj";
$dbname="users";
$dbc=@mysqli_connect($servername,$username,$password,$dbname);
$id=0;
$user=$_SESSION["uname"];
$name="anonymous";
$sql="DELETE FROM userin WHERE expirydate<NOW()";
mysqli_query($dbc,$sql);
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="dev2.css">
  </head>
  <body>
    <div style="top:50px;right:40px;position:absolute;z-index=1;visibility:show;">
      <p>Your Posts:
        <br>
        <?php
$sql="SELECT url,user FROM userin";
$result=mysqli_query($dbc,$sql);
while($row=mysqli_fetch_assoc($result)){
if($row["user"]==$user){
$id=$row["url"];
echo "<br><a href='show.php?id=$id'>$id</a><br>";
}
}
?>
      </p>
    </div>
    <div style="top:300px;right:40px;position:absolute;z-index=1;visibility:show;">
      <p>RecentPosts:
        <br>
        <?php
$sql="SELECT url,user,type,visible FROM userin";
$result=mysqli_query($dbc,$sql);
while($row=mysqli_fetch_assoc($result)){
if($row["user"]!=$user&&$row["visible"]=="Public"){
if( $row["type"]=="be known"){
$id=$row["url"];
$name=$row["user"];
}
else
$name="anonymous";
echo "<br><a href='show2.php?id=$id'> $id-$name </a><br>";
}
}
?>
      </p>
    </div>
    <ul>
      <li>
        <a href="signout.php">Sign Out-
          <?php echo $_SESSION['uname']; ?>
        </a>
      </li>
    </ul>
    <?php
date_default_timezone_set("Asia/Kolkata"); 
$user=$_SESSION["uname"];
$query="INSERT INTO userin (url,user,type,visible,language,createdate,expirydate,paste) VALUES (?,?,?,?,?,?,?,?)";
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
$type=(isset($_POST["type"])?$_POST["type"]:'');
$visible=(isset($_POST["visible"])?$_POST["visible"]:'');
$language=(isset($_POST["syntax"])?$_POST["syntax"]:'');
$date=date("Y-m-d H:i:s");
$enddate=date("Y-m-d H:i:s");
$time=time();
$expiry=(isset($_POST["expiry"])?$_POST["expiry"]:'');
if($expiry=="never")
$enddate=date("9999-12-31 23:59:59");
if($expiry=="1")
{$time+=60;
$enddate=date("Y-m-d H:i:s",$time);
}
if($expiry=="10")
{$time+=10*60;
$enddate=date("Y-m-d H:i:s",$time);
}
if($expiry=="1d")
{$time+=24*60*60;
$enddate=date("Y-m-d H:i:s",$time);
}
if($expiry=="1m")
{$time+=30*24*3600;
$enddate=date("Y-m-d H:i:s",$time);
}
if(isset($_FILES["file"])){
$errors=array();
$file_name=$_FILES["file"]["name"];
if($file_name!=""){
//echo var_dump($file_name);
$d=$file_name;
//$ext=end(explode('.',$file_name));
$file_size=$_FILES["file"]["size"];
$file_tmp=$_FILES["file"]["tmp_name"];
if($file_size> 2097152)
{$errors[]="Too large";
$okay=0;
}
//if($ext=="txt")
//{$errors[]="Invalid format";
//$okay=0;
//}
if(empty($errors)==true){
$textvalue=file_get_contents($_FILES["file"]["tmp_name"]);
move_uploaded_file($file_tmp,"uploads/".$file_name);
$okay=1;
}
}
}
if($okay==1 ){
mysqli_stmt_bind_param($stmt,"ssssssss",$id,$user,$type,$visible,$language,$date,$enddate,$textvalue);
mysqli_stmt_execute($stmt);
echo "Your id:".$id;
}
?>
    <div id="d1">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
        <textarea name="text" rows="30" cols="45" maxlength="800">
          <?php echo $textvalue; ?>
        </textarea>
        <br>
        Visiblility:
        <select name="visible">
          <option value="Private" selected>Private
          </option>
          <option value="Public">Public
          </option>
        </select>
        <br>
        <br>
        Type:    
        <select name="type">
          <option value="anonymous" selected>Anonymous
          </option>
          <option value="be known">Be-known
          </option>
        </select>
        <br>
        <br>
        Syntax:
        <select name="syntax">
          <option value="c">C
          </option>
          <option value="Apache">Apache
          </option>
          <option value="none" selected>None
          </option>
          <option value="Ruby">Ruby
          </option>
          <option value="C#">C#
          </option>
          <option value="Js">JavaScript
          </option>
          <option value="Css">Css
          </option>
          <option value="Bash">Bash
          </option>
          <option value="PHP">PHP
          </option>
          <option value="SQL">SQL
          </option>
          <option value="JSON">JSON
          </option>
          <option value="HTML">HTML,XML
          </option>
          <option value="Python">Python
          </option>
        </select>
        <br>
        <br>
        Expiry:
        <select name="expiry">
          <option value="never" selected>never
          </option>
          <option value="1">1 min
          </option>
          <option value="10">10 min
          </option>
          <option value="1d">1 day
          </option>
          <option value="1m">1 month
          </option>
        </select>
        <br>
        <br>
        File Upload(.txt only):
        <input type="file" name="file" value="" >
        <?php
if($okay==1)
{echo "success";
//echo $t;
}
?>
        <input type="submit" value="<?php echo $user ?>">
        <?php
if($okay==1)
echo "<input type='submit' formaction='show.php?id=$id' value='see your snippet'>";
?>
        </div>
      </body>
    </html>
