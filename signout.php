<?php
session_start();
?>
<?php
session_unset();
session_destroy();
header("Refresh:0;url=task3.php");
?>
