<?php
	require_once('session.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>로그아웃</title>
        <meta charset="utf-8"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <?php
            require_once('db.php');

            if(!isset($_SESSION['id'])){
                exit('<a href="javascript:history.go(-1)">로그인한 상태가 아닙니다.</a></body><html>');
            }

            $_SESSION = array();

            if(isset($_COOKIE[session_name()])){
                setcookie(session_name(), '', time() - (60*60));
            }

            session_destroy();

            setcookie('id', '', time() - (60*60));

            echo ('
            <script>
            alert("로그아웃 완료.");
            history.go(-1);
            </script>
            ');
            exit;
        ?>
    </body>
</html>