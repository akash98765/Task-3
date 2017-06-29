<?php
session_start();
$okay1=0;
$okay=0;
$_SESSION['secure']=rand(1000,9999);
?>
<img src="hey.php">
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="dev1.css">
  </head>
  <body>
    <?php 
if($_SESSION['error']==0)
$err="Invalid credentials";
else if($_SESSION['error1']==0)
$err="Invalid captcha";
?>
    <span class="s1">
      <?php echo $err; ?>
    </span>
    <form method="post" action="verify.php">
      <fieldset>
        <legend>Login
        </legend>
        <p>
          <label for="a">
            UserName:
          </label>
          <input type="text" name="uname"  required>
          <br>
        </p>
        <p>
          <label for="b">
            Password:
          </label>
          <input type="password" name="pass" required>
          <br>
        </p>
        <p>
          <label for="c">
            Captcha:
          </label>
          <input type="text" name="cap" required>
        </p>
        <br>
        <input type="submit" name="submit" value="submit">
      </fieldset>
    </form>
  </body>
</html>
