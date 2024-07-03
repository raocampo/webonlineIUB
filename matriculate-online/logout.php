<?php
session_start();
session_destroy();
header("Location: ../matriculate-online.php");
exit();
?>