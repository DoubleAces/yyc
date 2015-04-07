<script>
	$(function() {
		$('tr').click(function() {
			document.location = '/my/clients/' + $(this).attr('client');
		});
	});
</script>
<div class="main">
	<div class="container">
		<div class="row single-top">

			<!--	Left hand menu	-->

			<div class="col-md-4 ">
				<?$this->load->view('desktop/trainer/client_menu')?>
				<?$this->load->view('desktop/my/my_menu')?>
			</div>

			<!--	Content	-->

			kliendi andmed, treeneri märkused

		</div>
	</div>
</div>