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
				<table>
					<thead>
						<tr>
							<th>Nimi</th>
						</tr>
					</thead>
					<tbody>
						<? foreach ($plans as $plan): ?>
							<tr onclick="document.location.href='/my/clients/<?= $client->id ?>/plans/<?= $plan->id ?>'">
								<td><?= $plan->name ?></td>
							</tr>
						<? endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="clear"></div>

		</div>
	</div>
</div>