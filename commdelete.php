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
    $comment = $_GET['comment'];
?>
<html>
    <head>
        <title>댓글 삭제</title>
        <meta charset="utf-8"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <?php
            require_once('db.php');

            $dbc = mysqli_connect($host, $user, $pass, $dbname)
                or die("Error Connecting to MySQL Server.");
            
            mysqli_query($dbc, "set names utf8");

            $query = "delete from comm where number='$number' and comment='$comment'";

            $result = mysqli_query($dbc, $query)
                or die("Erro Querying database.");
            
            mysqli_close($dbc);

            echo ('
            <script>
            alert("댓글 삭제 완료.");
            history.go(-2);
            </script>
            ');
            exit;
        ?>
    </body>
</html>