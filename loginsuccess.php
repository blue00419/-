<?php
	require_once('session.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>로그인</title>
        <meta charset="utf-8"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <?php
            require_once('db.php');

            if(isset($_SESSION['id'])){
                exit('<a href="index.php">로그인한 상태입니다..</a></body><html>');
            }

            if(empty($_POST['id']) || empty($_POST['pw'])){
                exit('<a href="javascript:history.go(-1)">입력 폼을 채워주세요.</a></body><html>');
            }

            $dbc = mysqli_connect($host, $user, $pass, $dbname)
                or die("Error Connecting to MySQL Server.");
            
            $id = mysqli_real_escape_string($dbc, trim($_POST['id']));
            $pw = mysqli_real_escape_string($dbc, trim($_POST['pw']));

            mysqli_query($dbc, 'set names utf8');

            $query = "select * from person where id='$id'";

            $result = mysqli_query($dbc, $query)
                or die("Erro Querying database.");
            
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                $userid = $row['id'];
                $_SESSION['id'] = $userid;
                setcookie('id', $row['id'], time() + (60));
            }
            else {
                echo ('
                <script>
                alert("로그인 실패.");
                history.go(-1);
                </script>
                ');
            }
            mysqli_free_result($result);

            mysqli_close($dbc);

            echo ('
            <script>
            alert("로그인 완료.");
            history.go(-2);
            </script>
            ');
            exit;
        ?>
    </body>
</html>