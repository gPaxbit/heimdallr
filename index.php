<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Heim</title>

	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700&subset=latin,cyrillic-ext,latin-ext,cyrillic' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" href="./res/css/main.css" />
	<link rel="stylesheet" href="./res/css/jquery-ui.min.css" />
	<link rel="stylesheet" href="./res/css/jscrollpane.css" />

	<script src="/res/js/jquery.js"></script>
	<script src="/res/js/jquery-ui.min.js"></script>
	<script src="/res/js/jscrollpane.min.js"></script>
	<script src="/res/js/jquery.mousewheel.js"></script>
	<script src="/res/js/heim.js"></script>
	<script src="/res/js/search.js"></script>
	<script src="/res/js/add.js"></script>
	
</head>
<body>
	
	<div class="wrapper">
		<div class="sideNav">
			<h1><a href="/">HEIMDALLR</a></h1>
			<ul class="main">
				<li><a href="#ftp" data-hash="ftp" class="trigger ftp"><i class="icon">&#xe814;</i>FTP-Access</a>
					<ul class="sub">
						<li><a href="#ftp-show" data-event="show"><i class="icon">&#xe810;</i>Show</a></li>
						<li><a href="#ftp-add" data-event="add"><i class="icon">&#xe80f;</i>Add item..</a></li>
					</ul>
				</li>
				<li><a href="#pwd" data-hash="pwd" class="trigger pwd"><i class="icon">&#xe811;</i>Passwords</a>
					<ul class="sub">
						<li><a href="#pwd-show" data-event="show"><i class="icon">&#xe810;</i>Show</a></li>
						<li><a href="#pwd-add" data-event="add"><i class="icon">&#xe80f;</i>Add item..</a></li>
					</ul>
				</li>
				<li><a href="#note" data-hash="note" class="trigger note"><i class="icon">&#xe813;</i>Notes</a>
					<ul class="sub">
						<li><a href="#note-show" data-event="show"><i class="icon">&#xe810;</i>Show</a></li>
						<li><a href="#note-add" data-event="add"><i class="icon">&#xe80f;</i>Add note</a></li>
					</ul>    
				</li>
				<li><a href="#search" data-hash="search" class="trigger"><i class="icon">&#xe815;</i>Search</a></li>
				<li><a href="#setting" data-hash="sett" class="trigger"><i class="icon">&#xe801;</i>Setting</a></li>
				<li><span></span></li>
				<li><a href="#about" data-hash="heim" class="trigger"><i class="icon">&#xe805;</i>About heim</a></li>
			</ul>
		</div>

		<div class="content" id="content">
			<div id="result">
				<!-- <img src="res/img/q.gif" class="beforeUnload"/> -->
			</div>
		</div>

		<div class="blank"></div>

		<div class="overlay"></div>

		<div class="search">
			<form method="POST" id="searchForm">
				<input type="text" name="search" placeholder="Search..." />
				<select name="group">
					<option value="ftp">FTP</option>
					<option value="pwd">PASSWORD</option>
					<option value="note">NOTE</option>
				</select>
				<a class="icon send" href="#">&#xe815;</a>
			</form>
			<div class="matches"><div></div></div>
			<i>Press ESC to exit</i>
		</div>

	</div>
	
</body>
</html>