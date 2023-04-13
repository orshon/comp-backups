<?php
global $alert;
require "index.post.php";
$resV = "1.5.5";
echo <<<HTML
<!DOCTYPE html>
<html> 
    <head>
        <title>חממה טכנולוגית</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no">
		<meta name="author" content="החממה הטכנולוגית">
    	<meta name="description" content="יש תהליך עבודה (מבצעי\ניהולי) במסגרת עבודתכם הצבאית שתרצו לייעל ולהפוך לדיגיטלי? כתבו לנו רעיון ואנחנו נדאג לשאר!">
    	<meta name="theme-color" content="#21B3A8" />
        <meta name="color-scheme" content="#21B3A8" />
        <meta property="og:url" content="https://ttit.dacs.co.il/" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="חממה טכנולוגית" />
        <meta property="og:description" content="יש תהליך עבודה (מבצעי\ניהולי) במסגרת עבודתכם הצבאית שתרצו לייעל ולהפוך לדיגיטלי? כתבו לנו רעיון ואנחנו נדאג לשאר!">
        <meta property="og:image" content="https://ttit.dacs.co.il/res/img/icon.png" />
		<link rel="shortcut icon" href="res/img/icon.png" />
        <link rel="stylesheet" href="/res/css/bootstrap.min.css?v=$resV">
        <link rel="stylesheet" href="/res/css/index.css?v=$resV">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="/res/js/bootstrap.min.js"></script>
        <script src="/res/js/index.js"></script>
		<script src="https://www.google.com/recaptcha/api.js?render=6Lcpu3EaAAAAAF3OqYn00ZGRpC4F4c-5zqTBd_NG"></script>
		<script>grecaptcha.ready(() => grecaptcha.execute('6Lcpu3EaAAAAAF3OqYn00ZGRpC4F4c-5zqTBd_NG', {action:'validate_captcha'}).then((token) => document.getElementById('g-recaptcha-response').value = token));</script>
	</head>
	<body class="container-fluid bg-cover text-center">
			<div class="row">
				<div class="container container-fluid header"></div>
			</div>
			<div class="row mobile">
				<div class="col"><div class="title mobile">החממה הטכנולוגית</div></div>
			</div>
			<div class="row desktop">
				<div class="title">החממה הטכנולוגית</div>
			</div>
			<div class="row">
					<div class="textshow">יש תהליך עבודה (מבצעי\ניהולי) במסגרת עבודתכם הצבאית שתרצו לייעל ולהפוך לדיגיטלי? כתבו לנו רעיון ואנחנו נדאג לשאר!</div>
			</div>

					<br><br>
				<div class="row"><div class="col"></div><div class="col"><img class="pic" src="res/img/cp.jpeg"></div><div class="col"></div></div>
				<div class="row">
					<form id="myform" class="myform" method="POST" action="/" onsubmit="return validate(event);" >
						<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
    					<input type="hidden" name="action" value="validate_captcha">
						<input id="elname" name="name" autocomplete="off" class="form-control box " type="text" placeholder="שם מלא (רשות)"><br>
						<input id="elphone" name="phone" autocomplete="off" class="form-control box" type="text" placeholder="מספר טלפון (רשות)"><br>
						<input id="elemail" name="email" autocomplete="off" class="form-control box" type="text" placeholder="דואר אלקטרוני (רשות)"><br>
						<input id="elunit" name="unit" autocomplete="off" class="form-control box" type="text" placeholder="יחידה (רשות)"><br>
						<textarea id="eltext" name="text" autocomplete="off" rows="4" class="form-control box " placeholder="מה נוכל לפתח בשבילכם?" aria-describedby="ideatext"></textarea>
						<br>
						<button type="submit" class="btn btn-style shadow rounded">שלחו לנו</button>
					</form>
				</div>
				<div class="col-md-3 desktop"></div>
			</div>
			<div class="row">
				<div class="col text-center">
					<div class="comment" style="direction:ltr;color:#fff">
						<br>
                        This site is protected by reCAPTCHA and the Google
                        <a href="https://policies.google.com/privacy">Privacy Policy</a> and
                        <a href="https://policies.google.com/terms">Terms of Service</a> apply.
                    </div>
		</div>
		$alert
		<br>
	</body>
</html>
HTML;
