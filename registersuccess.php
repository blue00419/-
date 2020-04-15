<!DOCTYPE html>
<html>
    <head>
        <title>회원 가입</title>
        <meta charset="utf-8"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <?php
            require_once('db.php');

            if(empty($_POST['mem_no']) || empty($_POST['id']) || empty($_POST['pw']) 
                || empty($_POST['name']) || empty($_POST['location'])){
                exit('<a href="javascript:history.go(-1)">입력 폼을 채워주세요.</a>');
            }

            $dbc = mysqli_connect($host, $user, $pass, $dbname)
                or die("Error Connecting to MySQL Server.");
            
            mysqli_query($dbc, "set names utf8");

            $mem_no = mysqli_real_escape_string($dbc, trim($_POST['mem_no']));
            $id = mysqli_real_escape_string($dbc, trim($_POST['id']));
            $pw = mysqli_real_escape_string($dbc, trim($_POST['pw']));
            $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
            $location = mysqli_real_escape_string($dbc, trim($_POST['location']));

            $query = "select mem_no from person where mem_no='$mem_no'";

            $result = mysqli_query($dbc, $query)
                or die("Erro Querying database.");
            
            if(mysqli_num_rows($result) != 0){
                exit('<a href="javascript:history.go(-1)">이미 등록된 e-mail입니다.</a>');
            }
            mysqli_free_result($result);

            mysqli_query($dbc, 'set names utf8');

            $query = "insert into person values ($mem_no, '$id', SHA('$pw'), '$name', '$location')";

            $result = mysqli_query($dbc, $query)
                or die("Erro Querying database.");
            
            mysqli_close($dbc);

            echo ('
            <script>
            alert("회원 가입 완료.");
            history.go(-2);
            </script>
            ');
            exit;
        ?>
    </body>
</html>