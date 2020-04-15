<?php
	require_once('session.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>게시글 쓰기</title>
        <meta charset="utf-8"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <?php
            require_once('db.php');

            if(empty($_POST['title']) || empty($_POST['message'])){
                exit('<a href="javascript:history.go(-1)">입력 폼을 채워주세요.</a>');
            }

            $dbc = mysqli_connect($host, $user, $pass, $dbname)
                or die("Error Connecting to MySQL Server.");
            
            mysqli_query($dbc, "set names utf8");

            $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
            $message = mysqli_real_escape_string($dbc, trim($_POST['message']));

            $date = date('Y.m.d H:i');
            
            $query = "select * from person where id='".$_SESSION['id']."'";

            $result = mysqli_query($dbc, $query)
                or die("Erro Querying database.");

            $row = mysqli_fetch_assoc($result);
            $mem_no = $row['mem_no'];

            mysqli_free_result($result);
            mysqli_query($dbc, "set names utf8");
            
            $query = "insert into post values (null, $mem_no, '$title', '$date', 0, '$message')";

            $result = mysqli_query($dbc, $query)
                or die("Erro Querying database.");
            
            mysqli_close($dbc);

            echo ('
            <script>
            alert("게시글 입력 완료.");
            history.go(-2);
            </script>
            ');
            exit;
        ?>
    </body>
</html>