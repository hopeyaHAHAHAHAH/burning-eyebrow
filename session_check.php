<?php
if (!isset($_COOKIE["username"]) || empty($_COOKIE["username"])) {
    header("Location: login.html");
    exit;
}
?>
