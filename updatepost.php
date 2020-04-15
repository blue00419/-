<?php
	require_once('session.php');
?>
<!DOCTYPE html>
<?php
    require_once('db.php');
    $dbc = mysqli_connect($host, $user, $pass, $dbname)
        or die("Error Connecting to MySQL Server.");

    mysqli_query($dbc, "set names utf8");
    
    $number =  $_GET['number'];
?>
<html>
    <head>
        <title>게시글 수정</title>
        <meta charset="utf-8"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <?php
            require_once('db.php');

            if(empty($_POST['newtitle']) || empty($_POST['message'])){
                exit('<a href="javascript:history.go(-1)">입력 폼을 채워주세요.</a>');
            }

            $dbc = mysqli_connect($host, $user, $pass, $dbname)
                or die("Error Connecting to MySQL Server.");
            
            mysqli_query($dbc, "set names utf8");

            $newtitle = mysqli_real_escape_string($dbc, trim($_POST['newtitle']));
            $message = mysqli_real_escape_string($dbc, trim($_POST['message']));
            $date = date('Y.m.d H:i');

            $query = "update post set post_title='$newtitle', context='$message', date='$date' where number='$number'";

            $result = mysqli_query($dbc, $query)
                or die("Erro Querying database.");
            
            mysqli_close($dbc);

            echo ('
            <script>
            alert("게시글 수정 완료.");
            history.go(-3);
            </script>
            ');
            exit;
        ?>
    </body>
</html>