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
							<th>Nimi</th>
							<th>E-mail</th>
							<th>Viimane treening</th>
						</tr>
					</thead>
					<tbody>
						<?foreach($clients as $client):?>
							<tr onclick="document.location.href='/my/clients/<?=$client->id?>'">
								<td><?=$client->first_name?> <?=$client->last_name?></td>
								<td><?=$client->email?></td>
								<td style="color: red">Teadmata</td>
							</tr>
						<?endforeach?>
					</tbody>
				</table>
			</div>
			<div class="clear"></div>

		</div>
	</div>
</div>