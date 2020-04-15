<?php
	require_once('session.php');
?>
<!DOCTYPE HTML>
<?php
    require_once('db.php');
    $dbc = mysqli_connect($host, $user, $pass, $dbname)
        or die("Error Connecting to MySQL Server.");

    mysqli_query($dbc, "set names utf8");
    
    $number =  $_GET['number'];
?>
<!--
	Prologue by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>자취 생활 백서</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <style>
            #up {
                border: 1px solid powderblue;
            }
            td {
                border: 1px solid powderblue;
            }
            #context {
                text-align: left;
                font-size: 80%;
                padding: 10px;
            }
            #title {
                text-align: left;
                font-size: 150%;
                padding: 10px;
            }
            #comm {
                text-align: left;
                font-size: 100%;
                padding: 10px;
                height: 40px;
            }
        </style>
	</head>
	<body>

		<!-- Header -->
			<div id="header">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
							<span class="image avatar48"><img src="images/avatar.jpg" alt="" /></span>
							<?php
                                if(!isset($_SESSION['id']))
                                    echo '<h1>unknown</h1>';
                                else
                                    echo '<h1>'.$_SESSION["id"].'</h1>';
                            ?>
							<p></p>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<!--

								Prologue's nav expects links in one of two formats:

								1. Hash link (scrolls to a different section within the page)

								   <li><a href="#foobar" id="foobar-link" class="icon fa-whatever-icon-you-want skel-layers-ignoreHref"><span class="label">Foobar</span></a></li>

								2. Standard link (sends the user to another page/site)

								   <li><a href="http://foobar.tld" id="foobar-link" class="icon fa-whatever-icon-you-want"><span class="label">Foobar</span></a></li>

							-->
							<ul>
								<li><a href="./index.php#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">Home</span></a></li>
								<li><a href="./index.php#Play" id="Play-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Play</span></a></li>
							</ul>
						</nav>

				</div>
			</div>

		<!-- Main -->
			<div id="main">

				<!-- Play -->
                <section id="Play" class="one dark cover">
                    <div class="container">

                        <header>
                            <h2>Play</h2>
                        </header>

                        <?php
                           
                            // 게시글
                            $query = "select * from post where number='" . $number."'";

                            $result = mysqli_query($dbc, $query)
                                or die("Erro Querying database.");

                            $row = mysqli_fetch_assoc($result);
                            $no = $row[post_no];
                            $title = $row[post_title];
                            $date = $row[date];
                            $visit = $row[visit];
                            $context = $row[context];

                            mysqli_free_result($result);

                            $query = "select * from person where mem_no='" . $no . "'";

                            $result = mysqli_query($dbc, $query)
                                or die("Erro Querying database.");
                                
                            $row = mysqli_fetch_assoc($result);
                            $id = $row[id];
                            $location = $row[location];

                            echo "<div id='up'>";
                            echo "<table><h2><div id='title'><a href='post.php?number=$number'>". $title . "</a></div></h2></table>";
                            echo "<table><td>작성자 : " . $id . "</td><td>작성일 : " . $date . "</td><td>방문자 수 : " . $visit . "</td><td>위치 : " . $location . "</td></table>";
                            echo "<table><div id='context'>".$context . "</div></table></div>";

                            if(isset($_SESSION['id'])){
                                if(!strcmp($_SESSION['id'],$id)){
                                    echo '<div class="btn"><a href="./update.php?number='.$number.'" class="btnWrite btn pull-right">수정</a></div>';
                                    echo '<div class="btnWrite btn pull-right"> or </div>';
                                    echo '<div class="btn"><a href="./delete.php?number='.$number.'" class="btnWrite btn pull-right">삭제</a></div>';
                                }
                            }
                        ?>
                        <?php

                            // 댓글
                            echo "<br/>";
                            $query = "select * from comm where number='" . $number."'";

                            $result = mysqli_query($dbc, $query)
                                or die("Erro Querying database.");
                            
                            echo "<div id='up'>";
                            echo "<table><h2><div id='comm'>댓글</div></h2></table>";
                            while($row = mysqli_fetch_assoc($result)){

                                // join을 써버령러나ㅣㅓ리니아러ㅣㅏ너ㅣ라ㅓ니ㅏ러ㅣㅏ너이ㅏ러니ㅏㅇ러ㅣ넝러널
                                $query = "select id from person join comm on(mem_no='" . $row[comm_no]."')";

                                $re = mysqli_query($dbc, $query)
                                    or die("Erro Querying database.");

                                $rows = mysqli_fetch_assoc($re);
                                $id=$rows[id];
                                
                                echo "<table><td>작성자 : " . $id . "</td><td>작성일 : " . $row[date] . "</td></table>";
                                echo "<table><div id='context'>".$row[comment] . "</div></table>";

                                if(isset($_SESSION['id'])){
                                    if(!strcmp($_SESSION['id'],$id)){
                                        echo '<div class="btn"><a href="./commdelete.php?number='.$number.'&comment='.$row[comment].'" class="btnWrite btn pull-right">삭제</a></div>';
                                    }
                                }
                                echo "<br/>";
                            }
                            echo "</div>";    
                            echo "<br/>";
                            echo '<html><body><form method="post" action="comm.php?number=' . $number . '"';
                            echo '<div class="row"><div class="12u$">';
                            echo '<textarea name="message" placeholder="댓글을 입력하세요"></textarea></div>';
                            echo '<div class="12u$"><input type="submit" value="댓글 입력" /></div>';
                            echo '</div></form></body></html>';

                            mysqli_close($dbc); // close
                            

                        ?>
                    </div>
                </section>
			</div>

		<!-- Footer -->
			<div id="footer">

				<!-- Copyright -->
					<ul class="copyright">
						<li>&copy;<a href="http://www.kumoh.ac.kr">국립금오공과대학교</a> All Rights Reserved.
					</ul>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollzer.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>