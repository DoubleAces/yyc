<!DOCTYPE HTML>
<html>
	<head>
		<title>FitCom 2015</title>

		<!--	Meta Data	-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="keywords" content="" />

		<!--	CSS Files	-->
		<link href="<?=base_url()?>css/desktop/bootstrap.css" rel='stylesheet' type='text/css' />
		<link href="<?=base_url()?>css/mobile/style.css" rel='stylesheet' type='text/css' media="all" />
		<link href="<?=base_url()?>css/mobile/my.css" rel='stylesheet' type='text/css' />
		<link href="<?=base_url()?>css/mobile/magnific-popup.css" rel='stylesheet' type='text/css' />
		<link href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>

		<!--	JS Files	-->
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout( hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<script src="<?=base_url()?>js/jquery.min.js"></script>
		<script src="<?=base_url()?>js/magnific.js"></script>
		<script src="<?=base_url()?>js/jquery.mousewheel.js"></script>
		<script src="<?=base_url()?>js/jquery.contentcarousel.js"></script>
		<script src="<?=base_url()?>js/jquery.easing.1.3.js"></script>

		<script>
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
				});
			});
		</script>

	</head>
	<body>

		<!--	Mobile page header	-->

		<?$this->load->view('mobile/header')?>

		<!--	Mobile page body	-->

		<div class="main" style="min-height: 340px; background-color: #FFF;">
			<?$this->load->view($template)?>
		</div>

		<!--	Mobile page footer	-->

		<?$this->load->view('mobile/footer')?>

	</body>
</html>