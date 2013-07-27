<table class="table table-striped">
<tr>
	<td>Instrument</td>
	<td>Direction</td>
	<td>Open</td>
	<td>Stop</td>
	<td>Limit</td>
	<td>Profit</td>
	<td>Loss</td>
	<td>Active</td>
	<td>Result</td>
	<td>More</td>
</tr>
<?php foreach($trades as $t) : ?>
<tr>
	<td><?= $t->instrument ?></td>
	<td><?= $t->direction ?></td>
	<td><?= $t->open ?></td>
	<td><?= $t->stop ?></td>
	<td><?= $t->limit ?></td>
	<td><?= $t->net_profit_real ?></td>
	<td><?= $t->net_loss_real ?></td>
	<td><span class="glyphicon glyphicon-<?= ($t->active == '1') ? "ok" : "remove" ?>"></span></td>
	<td><?= $t->result ?></td>
	<td><a class="btn btn-primary" href="<?= BASE_URL ?>a/edit_trade/<?= $t->id ?>">More</a></td>
</tr>
<?php endforeach; ?>
</table>
