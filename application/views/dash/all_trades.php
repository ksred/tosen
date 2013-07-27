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
<tr class="<?= ($t->active == '1') ? "active-trade" : "" ?>">
	<td><?= $t->instrument ?></td>
	<td><?= $t->direction ?></td>
	<td><?= $currency.$t->open ?></td>
	<td><?= $currency.$t->stop ?></td>
	<td><?= $currency.$t->limit ?></td>
	<td class="table-profit"><?= $currency.$t->net_profit_real ?></td>
	<td class="table-loss"><?= $currency.$t->net_loss_real ?></td>
	<td><span class="glyphicon glyphicon-<?= ($t->active == '1') ? "ok" : "remove" ?>"></span></td>
	<td><?= $t->result ?></td>
	<td><a class="btn btn-primary" href="<?= BASE_URL ?>a/edit_trade/<?= $t->id ?>">More</a></td>
</tr>
<?php endforeach; ?>
</table>
