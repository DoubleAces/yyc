<script>
	$(function() {
		/* Magnific */
		$('.exercise-images').each(function() {
			$(this).magnificPopup({
				delegate: 'span a',
				type: 'image',
				gallery: {
					enabled: true
				}
			});
		});

		/* More pics link */
		var morePicsLink = $('.more-pics');
		morePicsLink.click(function() {

			var pics = $(this).parent().parent().find('span');
			if ($(this).hasClass('less')) {
				pics.each(function(i, pic) {
					if (i > 1) {
						$(pic).hide();
					}
				});
				$(this).removeClass('less').text('Veel pilte');
			}
			else {
				pics.show({easing: 'linear'});
				$(this).addClass('less').text('Vähem pilte');
			}
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
				<h4><?=$plan->name?></h4>
				<blockquote  style="margin-top: 10px; margin-bottom: 10px; font-size: 13px;"><?=$plan->description?></blockquote>
				<?foreach($exercises as $exercise) :
					?>
					<table>
						<thead>
						<tr>
							<th><?=$exercise->name?></th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>
								<div class="pull-left" style="width: 63%">
									<?
									$sets = $exercise->getSets();
									if ($sets) {
										?>
										<label style="width: 100%">Korduseid:</label>
										<?
										foreach ($exercise->getSets() as $set) {
											echo $set->sets . ' x ';
											echo $set->reps;
											if ($set->weight) {
												echo ' @ ' . $set->weight . 'kg';
											}
											?><br/><?
										}
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
									$i = 0;
									foreach ($exercise->images as $image) :
										?>
										<span style="margin-left: 10px; <?=$i > 1 ? 'display: none' : ''?>">
												<a href="<?=base_url()?>images/exercises/<?=$image->filename?>"><img alt="Harjutuse pilt" src="<?=base_url()?>images/exercises/120x120/<?=$image->filename?>" style="margin-bottom: 10px"></a>
											</span>
										<?
										$i++;
									endforeach;
									if ($exercise->imageCount > 2) {
										?><div><a class="more-pics">Veel pilte</a></div><?
									}
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