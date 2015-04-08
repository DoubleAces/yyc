<script>
	$(function() {
		var planButton = $('#addPlan');
		var planContainer = $('#newPlanFormContainer');
		planButton.click(function() {
			if (planContainer.css('display') != 'block') {
				planButton.html('Katkesta');
				planButton.removeClass('btn-info').addClass('btn-danger');
			}
			else {
				planButton.html('Lisa uus kava');
				planButton.removeClass('btn-danger').addClass('btn-info');
			}
			planContainer.toggle({
				easing: 'linear'
			});

		});
	});
</script>
<div class="main">
	<div class="container">
		<div class="row single-top">

			<!--	Left hand menu	-->

			<div class="col-md-4 ">
				<? $this->load->view('desktop/trainer/client_menu') ?>
				<? $this->load->view('desktop/my/my_menu') ?>
			</div>

			<!--	Content	-->

			<div class="col-md-8">

				<!--	New plan button	-->
				<div class="new-plan-button-container"><button class="btn btn-info" id="addPlan">Lisa uus kava</button></div>

				<!--	New plan form 	-->
				<div id="newPlanFormContainer" class="login-page override soft-hidden">
					<div class="login-title">
						<h4 class="title">Uue kava lisamine</h4>
						<div class="loginbox">
							<?=form_open('/my/clients/plans/create', 'method="post"')?>
								<input type="hidden" name="clientId" value="<?=$client->id?>">
								<fieldset class="input">
									<p><input class="inputbox" name="plan_name" placeholder="Kava nimetus" /></p>
									<p><textarea class="inputbox" name="plan_description" placeholder="Kava kirjeldus"></textarea></p>
									<div class="new-plan-button-container">
										<button type="button" class="btn btn-success btn-sm" onclick="this.form.submit()">Lisa kava</button>
										<div class="clear"></div>
									</div>
								</fieldset>
							<?=form_close()?>
						</div>
					</div>
				</div>

				<!--	Plans table	-->
				<table>
					<thead>
						<tr>
							<th>Nimi</th>
							<th>Lisatud</th>
						</tr>
					</thead>
					<tbody>
						<? foreach ($plans as $plan): ?>
							<tr onclick="document.location.href='/my/clients/<?= $client->id ?>/plans/<?= $plan->id ?>'">
								<td><?= $plan->name ?></td>
								<td><?= formatDate($plan->added) ?></td>
							</tr>
						<? endforeach ?>
					</tbody>
				</table>

			</div>
			<div class="clear"></div>

		</div>
	</div>
</div>