<script>
	$(function() {
		var exerciseButton = $('#addExercise');
		var exerciseContainer = $('#newExerciseFormContainer');
		exerciseButton.click(function() {
			if (exerciseContainer.css('display') != 'block') {
				exerciseButton.html('Katkesta');
				exerciseButton.removeClass('btn-info').addClass('btn-danger');
			}
			else {
				exerciseButton.html('Lisa uus kava');
				exerciseButton.removeClass('btn-danger').addClass('btn-info');
			}
			exerciseContainer.toggle({
				easing: 'linear'
			});
		});

		$('.upload').live('change', function(e) {
			var currentBox = $(e.currentTarget);
			var currentValue = currentBox.val();
			var currentCounter = parseInt(currentBox.attr('counter'));
			var fileStrBox = $('input[type="text"][counter=' + currentCounter + ']');
			fileStrBox.val(currentValue);
			if (currentCounter == <?=$allowedImageCount?>) {
				return;
			}
			var nextBox = $('input[type="text"][counter=' + (currentCounter + 1) + ']');
			var nextButton = $('input[type="file"][counter=' + (currentCounter + 1) + ']');

			if (nextBox.css('display') == 'none') {
				nextBox.removeClass('hidden');
				nextButton.parent().removeClass('hidden');
			}
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
				<div class="new-exercise-button-container"><button class="btn <?=$addFormOpen ? 'btn-danger' : 'btn-info'?>" id="addExercise"><?=$addFormOpen ? 'Katkesta' : 'Lisa uus harjutus'?></button></div>

				<!--	New plan form 	-->
				<div id="newExerciseFormContainer" class="login-page override <?=($addFormOpen ? '' : "soft-hidden")?>">
					<div class="login-title">
						<h4 class="title">Uue harjutuse lisamine</h4>
						<div class="loginbox">
							<?=form_open_multipart('/my/clients/plans/add-exercise', 'method="post"')?>
								<input type="hidden" name="clientId" value="<?=$client->id?>">
								<input type="hidden" name="planId" value="<?=$plan->id?>">
								<fieldset class="input">
									<p><?=form_error('name')?><input type="text" class="inputbox" name="name" placeholder="Harjutuse nimi"></p>
									<p><input type="text" class="inputbox" name="breathing" placeholder="Hingamine"></p>
									<p><input type="text" class="inputbox" name="reps" placeholder="Korduseid"></p>
									<p><textarea class="inputbox" name="description" placeholder="Harjutuse kirjeldus"></textarea></p>

									<?
									for ($i = 1; $i <= $allowedImageCount; $i++) {
										?>
										<input type="text" class="inputbox file <?=$i == 1 ? '' : 'hidden'?>" counter="<?=$i?>" placeholder="Vali fail" disabled="disabled" />
										<div class="fileUpload btn btn-primary <?=$i == 1 ? '' : 'hidden'?>">
											<span>Vali fail</span>
											<input type="file" class="upload" counter="<?=$i?>" name="photo<?=$i?>" />
										</div>
										<?
									}
									?>

									<div>
										<button type="button" class="btn btn-success btn-sm" onclick="this.form.submit()">Lisa harjutus</button>
										<div class="clear"></div>
									</div>
								</fieldset>
							<?=form_close()?>
						</div>
					</div>
				</div>

				<?foreach($exercises as $exercise) :?>

					<table>
						<thead>
							<tr>
								<th><?=$exercise->name?></th>
							</tr>
						</thead>
						<tbody>
							<td></td>
						</tbody>
					</table>

				<?endforeach?>

			</div>
			<div class="clear"></div>

		</div>
	</div>
</div>