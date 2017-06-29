<html>
  <head>
    <link rel="stylesheet" type="text/css" href="styles/purebasic.css">
    <style>
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
        <a href="signup.php">Sign Up
        </a>
      </li>
      <li>
        <a href="signin.php">Sign In
        </a>
      </li>
    </ul>
    <?php
$id=$_GET["id"];
$textvalue="";
$servername="localhost";
$username="root";
$password="Weiss-2sfj";
$dbname="users";
$dbc=@mysqli_connect($servername,$username,$password,$dbname);
$stmt="SELECT url,paste FROM userin";
$result=mysqli_query($dbc,$stmt);
while($row=mysqli_fetch_assoc($result)){if($id==$row["url"]){
$textvalue=$row["paste"];
$textvalue=htmlspecialchars($textvalue);
break;
}
}
?>
    <pre>
<code>
<?php echo $textvalue;
?>
<!--<?php echo $textvalue; ?>
-->
</code>
</pre>
  </body>
</html>
