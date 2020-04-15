<?php
	require_once('session.php');
?>
<!DOCTYPE HTML>
<?php
    require_once('db.php');
    $dbc = mysqli_connect($host, $user, $pass, $dbname)
        or die("Error Connecting to MySQL Server.");

    mysqli_query($dbc, "set names utf8");

    if(isset($_GET['page'])){
        $page=$_GET['page'];
    }else {
        $page = 1;
    }

    $query = 'select count(*) as post_title from post order by number asc';
    $result = mysqli_query($dbc, $query)
        or die("Erro Querying database.");
    $tmp = mysqli_fetch_array($result);
    $allPost = $tmp[post_title];
    
    $onePage = 5; // 한 페이지에 보여줄 게시글의 수.
    $allPage = ceil($allPost / $onePage); //전체 페이지의 수

    if($page < 1 || ($allPage && $page > $allPage)) {
    ?>
        <script>
		alert("존재하지 않는 페이지입니다.");
		history.back();
    	</script>
    <?php
        exit;
    }
    $oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
    $currentSection = ceil($page / $oneSection); //현재 섹션
    $allSection = ceil($allPage / $oneSection); //전체 섹션의 수

    $firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

    if($currentSection == $allSection) {
    	$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
    } else {
    	$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
    }

    $prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
    $nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

    $paging = '<ul>'; // 페이징을 저장할 변수

    //첫 페이지가 아니라면 처음 버튼을 생성
    if($page != 1) { 
    	$paging .= '<li class="page page_start"><a href="./index.php?page=1">처음</a></li>';
    }
    //첫 섹션이 아니라면 이전 버튼을 생성
    if($currentSection != 1) { 
    	$paging .= '<li class="page page_prev"><a href="./index.php?page=' . $prevPage . '">이전</a></li>';
    }

    for($i = $firstPage; $i <= $lastPage; $i++) {
    	if($i == $page) {
    		$paging .= '<li class="page current">' . $i . '</li>';
    	} else {
    		$paging .= '<li class="page"><a href="./index.php?page=' . $i . '">' . $i . '</a></li>';
    	}
    }

    //마지막 섹션이 아니라면 다음 버튼을 생성
    if($currentSection != $allSection) { 
        $paging .= '<li class="page page_next"><a href="./index.php?page=' . $nextPage . '">다음</a></li>';
    }

    //마지막 페이지가 아니라면 끝 버튼을 생성
    if($page != $allPage) { 
    	$paging .= '<li class="page page_end"><a href="./index.php?page=' . $allPage . '">끝</a></li>';
    }
    $paging .= '</ul>';

	$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
	
    $sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문
    $query = 'select * from post order by number asc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
    $result = mysqli_query($dbc, $query)
        or die("Erro Querying database.");

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
            table th{
                border: 1px solid black;
                font-family: verdana;
                font-size: 130%;
            }
            table tr:nth-child(odd){
                border: 1px solid powderblue;
            }
            li {
                display: inline;
                padding: 10px;
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
                                    echo '<h1 id="title">unknown</h1>';
                                else
									echo '<h1 id="title">'.$_SESSION["id"].'</h1>';
								
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
								<li><a href="#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">Home</span></a></li>
								<li><a href="#Play" id="Play-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Play</span></a></li>
							</ul>
						</nav>

				</div>
			</div>

		<!-- Main -->
			<div id="main">

				<!-- Intro -->
					<section id="top" class="one dark cover">
						<div class="container">

							<header>
								<h2>자취 생활 백서</h2>
								<p>시작 페이지입니다.</p>
                            </header>
                            <nav>
                                <ul>
									<?php
										if(!isset($_SESSION['id'])){
											echo '<li><a href="./register.php">회원가입</a></li>';
											echo '<li><a href="./login.php">로그인</a></li>';
										}
										else{
											echo '<li><a href="./logout.php">로그아웃</a></li>';
										}
									?>
                                    
                                </ul>
                            </nav>
						</div>
					</section>

				<!-- Play -->
					<section id="Play" class="two">
						<div class="container">

							<header>
								<h2>Play</h2>
							</header>

							<p>금오공대생이 직접 추천하는 학교 근처 놀거리 게시판.</p>
                            
							<table>
                            <tr>
                                <th>제목</th>
                                <th>작성자</th>
                                <th>날짜</th>
                                <th>위치</th>
                            </tr>

                            <?php
                                while($row = mysqli_fetch_assoc($result)){

									$post_title = $row[post_title];
									$date = $row[date];

									$query = 'select * from person where mem_no="' . $row[post_no] . '"';
									$re = mysqli_query($dbc, $query)
										or die("Erro Querying database.");
									
									$ro = mysqli_fetch_assoc($re);
									$id = $ro[id];
									$location = $ro[location];
									

                                    echo "<tr>";
                                    echo "<td><a href='post.php?number=$row[number]'>$post_title</a></td>";
                                    echo "<td><a href='post.php?number=$row[number]'>$id</a></td>";
                                    echo "<td><a href='post.php?number=$row[number]'>$date</a></td>";
                                    echo "<td><a href='post.php?number=$row[number]'>$location</a></td></tr>";
                                    
                                }
                            ?>
                            </table>

							


							<?php
								if(isset($_SESSION['id'])){
									echo '<div class="btn"><a href="./write.php" class="btnWrite btn pull-right">글쓰기</a></div>';
								}
							?>
                            
                            <div class="paging">
                                <?php echo $paging; ?>
                            </div>
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