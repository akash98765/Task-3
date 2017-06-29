<?php 
session_start();
$id=$_GET["id"];
$_SESSION["id"]=$id;
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="styles/purebasic.css">
    <style>
      .u1
      {
        list-style-type:none;
        background-color:white;
      }
      ul
      {
        list-style-type:none;
        background-color:#333333;
        padding:0px;
        overflow:hidden;
        margin:0px;
      }
      li
      {
        float:left;
      }
      li a
      {
        color:white;
        text-decoration:none;
        display:block;
        padding:20px;
      }
      li a:hover
      {
        text-decoration:underline;
        background-color:#111111;
      }
    </style>
  </head>
  <body style="background-color:white;">
    <script src="highlight.pack.js">
    </script>
    <script>hljs.initHighlightingOnLoad();
    </script>
    <ul>
      <li>
        <a href="welcome.php">My Bin
        </a>
      </li>
      <li>
        <a href="signout.php">Sign Out-
          <?php echo $_SESSION["uname"] ?>
        </a>
      </li>
      <li>
        <a href="modify.php">Edit It
        </a>
      </li>
    </ul>
    <?php
$user=$_SESSION["uname"];
$textvalue="";
$servername="localhost";
$username="root";
$password="Weiss-2sfj";
$dbname="users";
$date="";
$dbc=@mysqli_connect($servername,$username,$password,$dbname);
$stmt="SELECT url,createdate,paste FROM userin";
$result=mysqli_query($dbc,$stmt);
while($row=mysqli_fetch_assoc($result)){if($id==$row["url"]){
$textvalue=$row["paste"];
$date=$row["createdate"];
$textvalue=htmlspecialchars($textvalue);
break;
}
}
?>
    <pre>
<code>
<?php echo $textvalue;
?>
</code>
</pre>
  </body>
</html>
