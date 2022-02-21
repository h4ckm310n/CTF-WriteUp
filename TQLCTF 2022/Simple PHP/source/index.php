<?php
error_reporting(0);
if(isset($_POST['user']) && isset($_POST['pass'])){
	$hash_user = md5($_POST['user']);
	$hash_pass = 'zsf'.md5($_POST['pass']);
	if(isset($_POST['punctuation'])){
		//filter
		if (strlen($_POST['user']) > 6){
			echo("<script>alert('Username is too long!');</script>");
		}
		elseif(strlen($_POST['website']) > 25){
			echo("<script>alert('Website is too long!');</script>");
		}
		elseif(strlen($_POST['punctuation']) > 1000){
			echo("<script>alert('Punctuation is too long!');</script>");
		}
		else{
			if(preg_match('/[^\w\/\(\)\*<>]/', $_POST['user']) === 0){
				if (preg_match('/[^\w\/\*:\.\;\(\)\n<>]/', $_POST['website']) === 0){
					$_POST['punctuation'] = preg_replace("/[a-z,A-Z,0-9>\?]/","",$_POST['punctuation']);
					$template = file_get_contents('./template.html');
					$content = str_replace("__USER__", $_POST['user'], $template);
					$content = str_replace("__PASS__", $hash_pass, $content);
					$content = str_replace("__WEBSITE__", $_POST['website'], $content);
					$content = str_replace("__PUNC__", $_POST['punctuation'], $content);
					file_put_contents('sandbox/'.$hash_user.'.php', $content);
					echo("<script>alert('Successed!');</script>");
				}
				else{
					echo("<script>alert('Invalid chars in website!');</script>");
				}
			}
			else{
				echo("<script>alert('Invalid chars in username!');</script>");
			}
		}
	}
	else{
		setcookie("user", $_POST['user'], time()+3600);
		setcookie("pass", $hash_pass, time()+3600);
		Header("Location:sandbox/$hash_user.php");
	}
}
?>

<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Simple Linux</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<!--[if IE]>
		<script src="http://libs.baidu.com/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="jq22-container" style="padding-top:100px">
		<div class="login-wrap">
			<div class="login-html">
				<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
				<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
				<div class="login-form">
					<form action="index.php" method="post">
						<div class="sign-in-htm">
							<div class="group">
								<label for="user" class="label">Username</label>
								<input id="user" name="user" type="text" class="input">
							</div>
							<div class="group">
								<label for="pass" class="label">Password</label>
								<input id="pass" name="pass" type="password" class="input" data-type="password">
							</div>
							<!-- <div class="group">
								<input id="check" type="checkbox" class="check" checked>
								<label for="check"><span class="icon"></span> Keep me Signed in</label>
							</div> -->
							<div class="group">
								<input type="submit" class="button" value="Sign In">
							</div>
							<div class="hr"></div>
							<!-- <div class="foot-lnk">
								<a href="#forgot">Forgot Password?</a>
							</div> -->
						</div>
					</form>
					<form action="index.php" method="post">
						<div class="sign-up-htm">
							<div class="group">
								<label for="user" class="label">Username</label>
								<input id="user" name="user" type="text" class="input">
							</div>
							<div class="group">
								<label for="pass" class="label">Password</label>
								<input id="pass" name="pass" type="password" class="input" data-type="password">
							</div>
							<div class="group">
								<label for="pass" class="label">Your Website</label>
								<input id="pass" name="website" type="text" class="input">
							</div>
							<div class="group">
								<label for="pass" class="label">Your Punctuation</label>
								<input id="pass" name="punctuation" type="text" class="input">
							</div>
							<div class="group">
								<input type="submit" class="button" value="Sign Up">
							</div>
							<div class="hr"></div>
							<div class="foot-lnk">
								<label for="tab-1">Already Member?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>
