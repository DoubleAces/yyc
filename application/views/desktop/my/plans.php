<script>
	$(function() {
		$('tr').click(function() {
			document.location = '/my/training/plan/' + $(this).attr('plan');
		});
	});
</script>
<div class="main">
	<div class="container">
		<div class="row single-top">

			<!--	Left hand menu	-->

			<div class="col-md-4 ">
				<?$this->load->view('desktop/my/my_menu')?>
			</div>

			<!--	Content	-->

			<div class="col-md-8">

				<table>
					<thead>
						<tr>
							<th>Treener</th>
							<th>Treeningkava</th>
						</tr>
					</thead>
					<tbody>
						<?foreach($plans as $plan):?>
							<tr plan="<?=$plan->id?>">
								<td><?=$plan->trainer_name?></td>
								<td><?=$plan->name?></td>
							</tr>
						<?endforeach?>
					</tbody>
				</table>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>