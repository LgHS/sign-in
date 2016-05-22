<?php
	$baselines = [
		"Sign in for some Hackerspace magic.",
		"One sign-in page to rule them all.",
		"Join us now. Share the software. You'll be free."
	];
?><!doctype html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Sign in !</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="/dist/css/main.css">
</head>
<body>
	<header id="page-header">
		<h1><?php echo $baselines[array_rand($baselines)]; ?></h1>
	</header>

	<main id="content">
		<h2>
			<img src="/dist/svg/logo.svg" alt="Liege Hackerspace">
		</h2>
		<form id="sign-in-form">
			<p>
				<label for="sign-in_email" class="hide">E-mail</label>
				<input type="email" id="sign-in_email" name="sign-in_email" placeholder="Your email address">
			</p>
			<p>
				<label for="sign-in_password" class="hide">Password</label>
				<input type="password" id="sign-in_password" name="sign-in_password" placeholder="Your Password">
			</p>
			<p class="form-submit">
				<button type="submit" class="btn">Sign in</button>
			</p>
			<p class="form-help">
				<a href="" title="Recover your account">
					Lost your password ?
				</a>
			</p>
			<p class="bottom-cta">
				<a href="" title="Register an account">
					No account ? Register.
				</a>
			</p>
		</form>
	</main>

	<footer id="page-footer">
		<p>
			MAIL: ping[at]lghs.be
		</p>
		<p>
			IRC: #LgHS @ Freenode
		</p>
		<ul>
			<li>
				<a href="https://github.com/LgHS" title="Our Github repos">
					<i class="fa fa-github"></i>
					Github
				</a>
			</li>
			<li>
				<a href="https://www.facebook.com/liegehackerspace/" title="Our Facebook page">
					<i class="fa fa-facebook"></i>
					Facebook
				</a>
			</li>
			<li>
				<a href="https://twitter.com/LgHackerSpace" title="Our Twitter feed">
					<i class="fa fa-twitter"></i>
					Twitter
				</a>
			</li>
			<li>
				<a href="https://chat.lghs.be" title="Our Chat">
					<i class="fa fa-comment"></i>
					Chat
				</a>
			</li>
		</ul>
	</footer>
</body>
</html>