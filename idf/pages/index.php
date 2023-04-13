<?php
require "index.post.php";
$resV = "1.2.8";
echo <<<HTML
<!DOCTYPE html>
<html>
    <head>
        <title>חממה טכנולוגית</title><!-- Todo -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no">
		<meta name="author" content="החממה הטכנולוגית">
    	<meta name="description" content=""><!-- Todo -->
    	<meta name="theme-color" content="#5f9ea0" /><!-- Todo -->
        <meta name="color-scheme" content="#5f9ea0" /><!-- Todo -->
        <meta property="og:url" content="https://idf.dacs.co.il/" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="IDF" /><!-- Todo -->
        <meta property="og:description" content="" /><!-- Todo -->
        <meta property="og:image" content="https://dacs.co.il/res/img/icon.png" /> <!-- Todo -->
        <link rel="stylesheet" href="/res/css/bootstrap.min.css?v=$resV">
        <link rel="stylesheet" href="/res/css/index.css?v=$resV">
        <script src="/res/js/index.js"></script>
        <script scr="https://www.google.com/recaptcha/api.js"></script>
	</head>
	<body class="bg-cover">
		<div class="row">
			<div class="col">
				<img src="res/img/gdudi.png" class="img-fluid-left">
			</div>
			<div class="col"></div>
			<div class="col">
				<img src="res/img/pkmz.png" class="img-fluid-right">
			</div>
		</div>
		<div class="row"></div>
		<div class="row">
			<div class="col"></div>
			<div class="col text-center textshow">
				<h1 class="title" >החממה הטכנולוגית</h1>
				<h4 class="textshow">יש לכם צורך תקשובי כלשהו? תנו לנו לפתור לכם אותו! אנחנו צוות פיתוח תחת פיקוד מרכז שמחפש לענות על הצרכים שלכם. כתבו לנו כאן רעיונות לפרוייקטים הבאים שלנו ואנחנו נדאג לשאר! </h4>
				<br>
				<form>
					<input name="name" class="form-control box" type="text" placeholder="שם מלא"><br><br>
					<input name="contact" class="form-control box" type="text" placeholder="מספר טלפון"><br><br>
					<input name="id" class="form-control box" type="text" placeholder="יחידה"><br><br>
					<textarea name="idea" rows="4" class="form-control box" placeholder="מה נוכל לפתח בשבילכם?" aria-describedby="ideatext"></textarea><br>
					<div class="g_recaptcha brochure_form_captcha" data_sitekey=""></div>
					<button type="button" class="btn blue-gradient btn-rounded btn-style">שלחו לנו</button>
					<br><br><br>
				</form>
			</div>
			<div class="col"></div>
		</div>
	</body>
</html>
HTML;
