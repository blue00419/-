<?php
	require_once('session.php');
?>
<?php
    require_once('db.php');

    $dbc = mysqli_connect($host, $user, $pass, $dbname)
        or die("Error Connecting to MySQL Server.");
    
    mysqli_query($dbc, "set names utf8");

    $currentlimit =  $_GET['currentlimit'];
    $onepage = $_GET['onepage'];
    
    $query = 'select * from post order by number asc limit ' . $currentlimit . ", " . $onepage;
    $result = mysqli_query($dbc, $query)
        or die("Erro Querying database.");

    $json = array();

    if(mysqli_num_rows($result)){
        while($row = mysqli_fetch_assoc($result)){

            $requery = 'select * from person where mem_no="' . $row[post_no] . '"';
            $re = mysqli_query($dbc, $requery)
                or die("Erro Querying database.");
                
            $rejson = array();

            while($rerow = mysqli_fetch_assoc($re)){
                $rejson['mem'][] = $rerow;
            }

            $json['post'][] = $row + $rejson;

            mysqli_free_result($re);
        }
        mysqli_free_result($result);
    }

    echo json_encode($json);
    echo json_encode($rejson);
    mysqli_close($dbc);
?>





// index.php에 들어갔어야할 게시글 목록 출력 부분
// <div id="list">
//     <ul><li>aaa</li></ul>
// </div>

// <script>
//     $(document).ready(function(){
//         $("#list ul").empty();
//         var currentlimit = '<?php echo "$currentLimit"; ?>';
//         var onepage = '<?php echo "$onePage"; ?>';
//         $.getJSON("list.php?currentlimit=" + currentlimit + "&onepage=" + onepage + "", function(json){
//             var number = "";
//             var table = "<table>";
//             table += "<tr><th>제목</th><th>작성자</th><th>날짜</th><th>위치</th></tr>";
//             $.each(json.post, function(){
//                 number = this['number'];
//                 table += "<tr><td><a href='post.php?number=" + number + ">" + this['post_title'] + "</a></td>";
//             });
//             $.each(json.mem, function(){
//                 table += "<td><a href='post.php?number=" + number + ">" + this['id'] + "</a></td>";
//             });
//             $.each(json.post, function(){
//                 table += "<td><a href='post.php?number=" + number + ">" + this['date'] + "</a></td>";
//             });
//             $.each(json.mem, function(){
//                 table += "<td><a href='post.php?number=" + number + ">" + this['location'] + "</a></td></tr>";
//             });
//             table += "</table>";
//             $("#list ul").append(table);
//         });
//     });
// </script>