<!DOCTYPE HTML>
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
							<h1 id="title">unknown</h1>
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
				<!-- Intro -->
					<section id="top" class="one dark cover">
						<div class="container">

							<header>
								<h2>회원가입</h2>
                            </header>
                            <form method="post" action="registersuccess.php">
                            <div class="row">
                                <div class="6u 12u$(mobile)"><input type="text" name="mem_no" placeholder="본인의 학번을 입력하세요." /></div>
                                <div class="6u 12u$(mobile)"><input type="text" name="id" placeholder="사용하실 아이디를 입력하세요." /></div>
                                <div class="6u 12u$(mobile)"><input type="text" name="pw" placeholder="사용하실 비밀번호를 입력하세요." /></div>
                                <div class="6u 12u$(mobile)"><input type="text" name="name" placeholder="본인의 이름을 입력하세요." /></div>
                                <div class="6u 12u$(mobile)"><input type="text" name="location" placeholder="현제 거주지를 입력하세요." /></div>

                                <div class="12u$">
                                    <input type="submit" value="회원가입" />
                                </div>
                            </div>
                        </form>
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