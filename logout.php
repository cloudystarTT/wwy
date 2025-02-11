<?php

session_start();
session_destroy();
session_unset();
session_abort();
session_reset();

header("Location: login.php");

?>