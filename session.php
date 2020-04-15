<?php
    session_start();
    ob_start();

    if(!isset($_SESSION['id'])){
        if(isset($_COOKIE['id'])){
            $userid = $_COOKIE['id'];
            $_SESSION['id']=$userid;
        }
    }
?>