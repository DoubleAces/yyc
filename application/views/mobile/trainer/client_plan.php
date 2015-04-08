<script>
	$(function() {

		/* Enable/disable the add exercise form */
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

		/* Adding new image upload boxes */
		$('.upload').live('change', function(e) {
			var currentBox = $(e.currentTarget);
			var currentValue = currentBox.val();

			var currentCounter = parseInt(currentBox.attr('class').split('-')[1]);
			var fileStrBox = $('input[type="text"][class^=file-' + currentCounter + ']');
			fileStrBox.val(currentValue);
			if (currentCounter == <?=$allowedImageCount?>) {
				return;
			}
			var nextBox = $('input[type="text"][class^=file-' + (currentCounter + 1) + ']');
			var nextButton = $('input[type="file"][class$=file-' + (currentCounter + 1) + ']');

			if (nextBox.css('display') == 'none') {
				nextBox.removeClass('hidden');
				nextButton.parent().removeClass('hidden');
			}
		});

		/* Magnific */
		$('.exercise-images').each(function() {
			$(this).magnificPopup({
				delegate: 'a',
				type: 'image',
				gallery: {
					enabled: true
				}
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
									<input type="text" class="file-<?=$i?> inputbox file <?=$i == 1 ? '' : 'hidden'?>" placeholder="Vali fail" disabled="disabled" />
									<div class="fileUpload btn btn-primary <?=$i == 1 ? '' : 'hidden'?>">
										<span>Vali fail</span>
										<input type="file" class="upload file-<?=$i?>" name="photo<?=$i?>" />
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


				<?foreach($exercises as $exercise) :
					?>

					<table>
						<thead>
						<tr>
							<th><?=$exercise->name?></th>
							<th style="width: 10%; text-shadow: 0 1px 0 #FFF"><a href="/my/clients/plans/delete_exercise/<?=$exercise->id?>" style="color: red">Kustuta</a></th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td colspan="2">
								<div class="pull-left" style="width: 63%">
									<?
									if ($exercise->reps) {
										?><label>Korduseid: </label> <?=$exercise->reps?><br /><?;
									}
									if ($exercise->breathing) {
										?><label>Hingamine: </label> <?=$exercise->breathing;
									}
									if ($exercise->description) {
										?><br /><?=$exercise->description;
									}
									?>
								</div>
								<div class="pull-right exercise-images" style="width: 37%; text-align: right"><?
									foreach ($exercise->images as $image) :
										?>
										<span style="margin-left: 10px;"><a href="<?=base_url()?>images/exercises/<?=$image->filename?>"><img alt="Harjutuse pilt" src="<?=base_url()?>images/exercises/120x120/<?=$image->filename?>" style="margin-bottom: 10px"></a></span>
									<?
									endforeach
									?>
								</div>
							</td>
						</tr>
						</tbody>
					</table>
				<?
				endforeach?>

			</div>
			<div class="clear"></div>

		</div>
	</div>
</div>