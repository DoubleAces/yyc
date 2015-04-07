<!DOCTYPE HTML>
<html>
	<head>
		<title>FitCom 2015</title>
		<link href="<?=base_url()?>css/desktop/bootstrap.css" rel='stylesheet' type='text/css' />
		<link href="<?=base_url()?>css/desktop/style.css" rel='stylesheet' type='text/css' />
		<link href="<?=base_url()?>css/desktop/my.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<script src=<?=base_url?>js/jquery.min.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
				});
			});
		</script>

		<!-- grid-slider -->
		<script type="text/javascript" src="<?=base_url?>js/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="<?=base_url?>js/jquery.contentcarousel.js"></script>
		<script type="text/javascript" src="<?=base_url?>js/jquery.easing.1.3.js"></script>

	</head>
	<body>

		<?=$this->load->view('desktop/header')?>

		<div class="header">
			<div class="container">
				<div class="header-text">

					<!--	Login form	-->
					<h1>Login</h1>
					<form method="post" action="/home/enter">
						<div class="to">
							<input type="text" name="username" class="homeInput text" placeholder="Username" ">
							<input type="password" name="password" class="homeInput text" placeholder="Password" style="margin-left:20px;">
							<input type="submit" value="Login" class="homeLoginButton" />
						</div>
						<div class="clear"></div>
					</form>

				</div>
				<div class="header-arrow">
					<a href="#menu" class="class scroll"><span> </span </a>
				</div>
			</div>
		</div>

		<?=$this->load->view('desktop/footer')?>

	</body>
</html>